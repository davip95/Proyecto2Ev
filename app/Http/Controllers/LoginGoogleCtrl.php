<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleCtrl extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        if (User::select()->where('email', $googleUser->email)->first()) {
            $user = User::select()->where('email', $googleUser->email)->first();
            Auth::login($user);
            session(['hora' => date('H:i:s')]);
            return redirect()->action([TareasCtrl::class, 'index']);
        }
        $user = User::updateOrCreate([
            'provider_id' => $googleUser->id,
        ], [
            'name' => $googleUser->user['given_name'],
            'email' => $googleUser->email,
            'fechaalta' => Carbon::now(),
            'tipo' => 'operario'
        ]);
        session(['hora' => date('H:i:s')]);
        Auth::login($user);
        $usuario = Auth::user();
        return redirect()->action([UsersCtrl::class, 'edit'], ['usuario' => $usuario]);
    }
}
