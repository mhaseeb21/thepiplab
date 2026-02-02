<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MarketWidgetController extends Controller
{
    public function index()
    {
        $data = Cache::remember('market_widget_v4', 60, function () {

            // ----------------------------
            // FX (Frankfurter - stable)
            // ----------------------------
            $fxPairs = [];
            try {
                $fxRes = Http::timeout(10)->get('https://api.frankfurter.app/latest', [
                    'from' => 'USD',
                    'to'   => 'EUR,GBP,JPY',
                ]);

                if (!$fxRes->successful()) {
                    Log::error('FX API failed', ['status' => $fxRes->status(), 'body' => $fxRes->body()]);
                }

                $fx = $fxRes->json();
                $rates = $fx['rates'] ?? [];

                $fxPairs = [
                    ['pair' => 'EUR/USD', 'value' => isset($rates['EUR']) ? round(1 / $rates['EUR'], 4) : null],
                    ['pair' => 'GBP/USD', 'value' => isset($rates['GBP']) ? round(1 / $rates['GBP'], 4) : null],
                    ['pair' => 'USD/JPY', 'value' => $rates['JPY'] ?? null],
                ];
            } catch (\Throwable $e) {
                Log::error('FX exception', ['msg' => $e->getMessage()]);
            }

            // ----------------------------
            // Indices (Stooq CSV + fallbacks)
            // ----------------------------
            $indices = [];
            $today = now()->toDateString();

            $targets = [
                [
                    'name' => 'S&P 500',
                    // Try multiple candidate symbols until one works
                    'symbols' => ['spx', '^spx', 'spx.us', '^spx.us'],
                ],
                [
                    'name' => 'Nasdaq 100',
                    'symbols' => ['ndx', '^ndx', 'ndx.us', '^ndx.us'],
                ],
                [
                    'name' => 'Dow Jones',
                    'symbols' => ['dji', '^dji', 'dji.us', '^dji.us'],
                ],
            ];

            foreach ($targets as $t) {
                $close = $this->fetchStooqCloseWithFallback($t['symbols']);
                if ($close !== null) {
                    $indices[] = [
                        'name'  => $t['name'],
                        'close' => $close,
                        'date'  => $today,
                    ];
                }
            }

            return [
                'fx' => $fxPairs,
                'indices' => $indices,
                'updated_at' => now()->toDateTimeString(),
            ];
        });

        return response()->json($data);
    }

    /**
     * Try many Stooq symbols and return the first valid close price.
     */
    private function fetchStooqCloseWithFallback(array $symbols): ?float
    {
        foreach ($symbols as $sym) {
            $sym = strtolower($sym);

            try {
                $url = "https://stooq.com/q/d/l/?s={$sym}&i=d";

                $res = Http::timeout(10)
                    ->withHeaders(['User-Agent' => 'Mozilla/5.0'])
                    ->get($url);

                if (!$res->successful()) {
                    Log::warning('Stooq not successful', ['symbol' => $sym, 'status' => $res->status()]);
                    continue;
                }

                $body = trim($res->body());
                $lines = preg_split("/\r\n|\n|\r/", $body);

                // Must have header + at least one row
                if (!$lines || count($lines) < 2) {
                    Log::warning('Stooq empty/short CSV', ['symbol' => $sym]);
                    continue;
                }

                // last line should be latest row, but sometimes last is empty -> scan backwards
                for ($i = count($lines) - 1; $i >= 1; $i--) {
                    $line = trim($lines[$i]);
                    if ($line === '') continue;

                    $parts = str_getcsv($line);
                    // expected: Date,Open,High,Low,Close,Volume
                    $close = $parts[4] ?? null;

                    if ($close !== null && is_numeric($close) && (float)$close > 0) {
                        Log::info('Stooq OK', ['symbol' => $sym, 'close' => $close]);
                        return (float)$close;
                    }
                }

                Log::warning('Stooq no numeric close', ['symbol' => $sym]);

            } catch (\Throwable $e) {
                Log::error('Stooq exception', ['symbol' => $sym, 'msg' => $e->getMessage()]);
                continue;
            }
        }

        return null;
    }
}
