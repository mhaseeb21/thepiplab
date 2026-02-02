<?php

namespace App\Http\Controllers;

use App\Models\Signal;

class PublicSignalController extends Controller
{
    // Results list (you already have this)
    public function index()
    {
        $signals = Signal::where('result_status', '!=', 'pending')
            ->orderByDesc('updated_at')
            ->paginate(12);

        return view('signals_results', compact('signals'));
    }

    // ✅ Public result details page
    public function show(Signal $signal)
    {
        // Extra safety: don’t allow pending signals
        abort_if($signal->result_status === 'pending', 404);

        return view('signal_result_show', compact('signal'));
    }
}