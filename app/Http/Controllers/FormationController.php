<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cours;
use App\Models\Formation;
use App\Models\User;
use App\Models\Planning;
use Illuminate\Support\Facades\DB;


class FormationController extends Controller
{
    
    // ADMIN: liste des formations
        public function formationsList()
        {
            $formations = Formation::all();
            return view('admin.formations.list')->with('formations', $formations);
        }

    // ADMIN: ajouter une formation
        public function addFormationForm()
        {
            return view('admin.formations.add');
        }

        public function addFormation(Request $request)
        {
            $request->validate([
                'nom' => 'required|string|min:2|max:40',
            ]);

            $formation = new Formation();
            $formation->intitule = $request->nom;
            $formation->save();
            $request->session()->flash('etat', 'La formation a été créée avec succès');
            return redirect()->route('admin.page');
        }

    //ADMIN: Modifier une formation
        public function editFormation(Request $request)
        {
            $request->validate([
                'intitule' => 'required|string|min:2|max:40',
            ]);

            $formation = Formation::where('id', $request->formation)->first();
            $formation->intitule = $request->intitule;
            $formation->save();
            $request->session()->flash('etat', 'Formation modifiée avec succès');
            return back();
        }

    //ADMIN: Supprimer une formation
        public function delFormation(Request $request)
        {
            //on recupere la formation
            $formation = Formation::where('id', $request->formation)->first();
            //on recupere les utilisateurs de la formation
            $users=User::where('formation_id', $request->formation)->get();

            //on supprime les utilisateurs
            foreach($users as $user){
                //on supprime les cours ou les utilisateurs sont inscrits
                $cours = $user->cours()->get();
                foreach ($cours as $cour) {
                    //on supprime les plannings de ces cours
                    $plannings = Planning::where('cours_id', $cour->id)->get();
                    foreach ($plannings as $planning) {
                        $planning->delete();
                    }
                    //on supprime les relations entre les cours et les utilisateurs
                    $u = $cour->users;
                    foreach ($u as $u) {
                        $u->pivot->delete();
                    }
                    //on supprime les cours
                    $cour->delete();
                }
                //on supprime les utilisateurs
                $user->delete();
            }

            //on recupere les cours de la formation
            $cours = Cours::where('formation_id', $request->formation)->get();

            //on supprime les cours et on met a jour les champs formation_id
            foreach ($cours as $cour) {
                if($cour->formation_id==$formation->id){
                    DB::table('cours_users')->where('cours_id',$cour->id)->delete();
                    Planning::where('cours_id', $cour->id)->delete();
                    $cour->delete();
                };
                
                $cour->formation_id = NULL;
                $cour->save();
            
            }
            $formation->delete();
            $request->session()->flash('etat', 'Formation supprimée avec succès');
            return back();
        }

    // STUDENT: Lister les cours d'une formation
        public function coursList()
        {
            $u = User::where('id', auth()->user()->id)->first();
            if ($u->formation == null) {
                return back()->withErrors('Vous n\'êtes inscrit à aucune formation');
            }
            return view('student.formations.coursList')->with('user', $u);
        }

}
