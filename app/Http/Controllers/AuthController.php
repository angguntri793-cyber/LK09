<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use WorkOS\WorkOS;
use WorkOS\Resource\SSOProvider;

class AuthController extends Controller
{
    private WorkOS $workos;

    public function __construct()
    {
        // SDK v7: instantiate object, bukan static call
        // Otomatis baca WORKOS_API_KEY dan WORKOS_CLIENT_ID dari env
        $this->workos = new WorkOS(
            apiKey:   env('WORKOS_API_KEY'),
            clientId: env('WORKOS_CLIENT_ID'),
        );
    }

    // =========================
    // REDIRECT LOGIN GOOGLE
    // =========================
    public function redirectToGoogle()
    {
        // SDK v7: $redirectUri WAJIB di posisi pertama, provider pakai Enum
        $authUrl = $this->workos->sso()->getAuthorizationUrl(
            redirectUri: env('WORKOS_REDIRECT_URI'),
            provider: SSOProvider::GoogleOAuth,
        );

        return redirect($authUrl);
    }

    // =========================
    // CALLBACK WORKOS
    // =========================
    public function handleCallback(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            return redirect('/login')->with('error', 'Authorization code tidak ditemukan');
        }

        try {
            $tokenResponse = $this->workos->sso()->getProfileAndToken($code);
            $profile = $tokenResponse->profile;

            $firstName = $profile->firstName ?? '';
            $lastName  = $profile->lastName  ?? '';
            $fullName  = trim($firstName . ' ' . $lastName);

            if (empty($fullName)) {
                $fullName = explode('@', $profile->email)[0];
            }

            $user = \App\Models\User::updateOrCreate(
                ['email' => $profile->email],
                [
                    'name'     => $fullName,
                    'password' => bcrypt(Str::random(16)),
                ]
            );

            Auth::login($user);

            return redirect('/books');

        } catch (\Exception $e) {
            \Log::error('WorkOS Auth Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Gagal autentikasi: ' . $e->getMessage());
        }
    }

    // =========================
    // LOGOUT
    // =========================
   public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
}