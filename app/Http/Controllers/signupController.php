<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class signupController extends Controller
{
    public function index($referral_code = null)
    {
        return view('signup', ['referral_code' => $referral_code]);
    }

    public function register(Request $request)
    {
        try {
            // ✅ Validate fields
            $validated = $request->validate([
                'name'                  => 'required|string|max:255',
                'email'                 => 'required|string|email|max:255|unique:users,email',
                'password'              => 'required|string|min:8|confirmed',

                // Referral code is optional - validate manually (do not use "exists" because
                // your referral_code is in users.referral_code, not users.id)
                'referral_code'         => 'nullable|string|max:50',

                // phone inputs from frontend
                'country_code'          => 'required|string|max:6',
                'contact'               => 'required|string|min:7|max:15',

                // Turnstile token (created by the widget)
                'cf-turnstile-response' => 'required|string',
            ]);

            // ✅ Phone number: digits only
            $contactDigits = preg_replace('/\D+/', '', (string) $request->contact);

            if ($contactDigits !== (string) $request->contact) {
                return back()->withInput()->withErrors([
                    'contact' => 'Phone number must contain digits only.',
                ]);
            }

            if (strlen($contactDigits) < 7 || strlen($contactDigits) > 15) {
                return back()->withInput()->withErrors([
                    'contact' => 'Phone number must be between 7 and 15 digits.',
                ]);
            }

            // ✅ Combine country code + number
            $fullPhoneNumber = $request->country_code . $contactDigits;

            // ✅ Find referrer (if any)
            $referrer = null;
            if ($request->filled('referral_code')) {
                $referrer = User::where('referral_code', $request->referral_code)->first();

                if (!$referrer) {
                    return back()->withInput()->withErrors([
                        'referral_code' => 'Referral code is invalid.',
                    ]);
                }
            }

            // ✅ Generate unique referral code for new user
            do {
                $generatedReferralCode = Str::upper(Str::random(10));
            } while (User::where('referral_code', $generatedReferralCode)->exists());

            // ✅ Create user
            $user = User::create([
                'name'           => $request->name,
                'email'          => $request->email,
                'password'       => Hash::make($request->password),
                'role'           => 'customer',
                'ib_status'      => false,
                'referred_by'    => $referrer ? $referrer->id : null,
                'referral_code'  => $generatedReferralCode,
                'contact_number' => $fullPhoneNumber,
            ]);

            // ✅ Auto login
            auth()->login($user);
            $request->session()->regenerate();

            // ✅ Send Laravel built-in email verification notification
            $user->sendEmailVerificationNotification();

            // ✅ Redirect to verification notice page
            return redirect()->route('verification.notice');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Laravel will auto-redirect with errors; just rethrow
            throw $e;

        } catch (\Throwable $e) {
            Log::error('Signup error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}
