<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginCtrl extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        if (User::select()->where('email', $githubUser->email)->first()) {
            $user = User::select()->where('email', $githubUser->email)->first();
            Auth::login($user);
            session(['hora' => date('H:i:s')]);
            return redirect()->action([TareasCtrl::class, 'index']);
        }
        $user = User::updateOrCreate([
            'provider_id' => $githubUser->id,
        ], [
            'name' => $githubUser->nickname,
            'email' => $githubUser->email,
            'fechaalta' => Carbon::now(),
            'tipo' => 'operario'
        ]);
        session(['hora' => date('H:i:s')]);
        Auth::login($user);
        $usuario = Auth::user();
        return redirect()->action([UsersCtrl::class, 'edit'], ['usuario' => $usuario]);
    }
}
