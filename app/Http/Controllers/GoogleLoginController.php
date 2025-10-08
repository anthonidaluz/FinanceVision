<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    /**
     * Redireciona o utilizador para a página de autenticação do Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtém as informações do utilizador do Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended('dashboard');
            } else {
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    $user->update(['google_id' => $googleUser->getId()]);
                } else {
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'password' => Hash::make(uniqid()),
                    ]);
                }

                Auth::login($user);
                return redirect()->intended('dashboard');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Algo correu mal ao tentar autenticar com o Google.');
        }
    }
}