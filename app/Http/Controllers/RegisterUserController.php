<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function registerProfForm()
    {
        return view('authentication.registerProf');
    }

    public function registerProf(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:20',
            'prenom' => 'required|string|max:20',
            'login' => 'required|string|max:30|unique:users',
            'mdp' => 'required|string|confirmed|min:2|max:30'
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->type = null;

        $user->save();
        $request->session()->flash('etat', 'Votre compte a été créé, veuillez attendre la validation de l\'administrateur');

        return redirect()->route('main');
    }
    public function registerStudentForm()
    {
        $form = Formation::all();
        return view('authentication.registerStudent', ['formations' => $form]);
    }

    public function registerStudent(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:20',
            'prenom' => 'required|string|max:20',
            'login' => 'required|string|max:15|unique:users',
            'mdp' => 'required|string|confirmed|min:2|max:30',
            'formation' => 'required'
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->formation_id = intval($request->formation);
        $user->type = null;

        $user->save();
        $request->session()->flash('etat', 'Votre compte a été créé, veuillez attendre la validation de l\'administrateur');


        return redirect()->route('main');
    }
}
