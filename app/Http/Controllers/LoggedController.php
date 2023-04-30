<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoggedController extends Controller
{
    public function formLogin(){
        return view('authentication.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'mdp' => 'required|string'
        ]);

        $credentials = ['login' => $request->login,
            'password' => $request->mdp];

        $u = User::where('login', $request->login)->first();

        if (!$u) {
            return back()->withErrors([
                'login' => 'Votre login n\'existe pas',
            ]);
        }

        if (!isset($u->type) && $u->type == null) {
            return back()->withErrors([
                'login' => 'votre compte n\'est pas encore activé, veuillez contacter l\'administrateur',
            ]);
        }
         
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->flash('etat','Login réussi');
            return redirect()->intended('/Home');
        }

        return back()->withErrors([
            'login' => 'Votre mot de passe est incorrect',
        ]);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('Login');
    }


}
