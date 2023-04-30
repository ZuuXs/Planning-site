<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cours;
use App\Models\Formation;
use App\Models\User;


class CoursController extends Controller
{
    // ADMIN: Lister les cours
        public function coursList()
        {
            $cours = Cours::all();
            $formations = Formation::all();
            $profs = User::where('type', 'enseignant')->get();
            return view('admin.cours.list')->with('cours', $cours)->with('formations', $formations)->with('profs', $profs);
        }

    // ADMIN: Lister les cours par prof
        public function coursListByProfForm()
        {
            $profs = User::where('type', 'enseignant')->get();
            return view('admin.cours.selectProf')->with('profs', $profs);
        }

        public function coursListByProf(Request $request)
        {
            $request->validate([
                'prof' => 'required',
            ]);
            $prof = User::where('id', $request->prof)->first();
            $cours = $prof->cours()->get();
            return view('admin.cours.listByProf')->with('cours', $cours)->with('prof', $prof);
        }


    // ADMIN: Créer un cours
        public function addCoursForm()
        {
            $profs = User::where('type', 'enseignant')->get();
            $formations = Formation::all();
            return view('admin.cours.add')->with('profs', $profs)->with('formations', $formations);;
        }

        public function addCours(Request $request)
        {
            $request->validate([
                'nom' => 'required|string|min:2|max:30',
                'formation' => 'required',
                'prof' => 'required',
            ]);

            $cours = new Cours();
            $cours->intitule = $request->nom;
            $cours->formation_id = intval($request->formation);
            $cours->user_id = $request->prof;

            $cours->save();
            $request->session()->flash('etat', 'Le cours a été créé avec succès');
            return redirect()->route('admin.page');
        }

    // ADMIN: Modifier un cours
    
        public function editCours(Request $request)
        {
            $request->validate([
                'cours'=>'required',
            ]);

            $cours = Cours::find($request->cours);
            if ($request->intitule != null) {
                $cours->intitule = $request->intitule;
                $cours->save();
                $request->session()->flash('etat', 'Intitulé modifié avec succès');
            }
            if ($request->formation != null) {
                $cours->formation_id = intval($request->formation);
                $cours->save();

                $request->session()->flash('etat', 'Formation modifiée avec succès');
            }

            if ($request->prof != null) {
                $cours->user_id = $request->prof;
                $cours->save();
                $request->session()->flash('etat', 'Enseignant modifié avec succès');
            }

            $cours->save();
            return back();
        }

    // ADMIN: Supprimer un cours
        public function delCours(Request $request)
        {
            $request->validate([
                'cours' => 'required'
            ]);

            $cours = Cours::find($request->cours);
            $plannings = $cours->plannings;
            foreach ($plannings as $planning) {
                $planning->delete();
            }

            $users = $cours->users;
            foreach ($users as $user) {
                $user->cours()->detach($cours);
            }

            $cours->delete();
            $request->session()->flash('etat', 'Le cours a été supprimé avec succès');
            return back();
        }

    // ADMIN: Recherche cours
        public function coursSearchAdmin(Request $request)
        {
            $request->validate([
                'cours' => 'required',
            ]);

            $cours = Cours::where('intitule', 'LIKE', "%{$request->cours}%")->get();
            if ($cours == null) {
                return back()->withErrors('Aucun cours trouvé');
            }
            return view('admin.cours.searchResult')->with('cours', $cours);
        }

    // PROF: Lister les cours      
        public function coursListProf()
        {
            $u = auth()->user()->id;
            $cours = Cours::where('user_id', "=", "$u")->get();
            return view('prof.cours.list')->with('cours', $cours);
        }

    // STUDENT: S'inscrire à un cours
        public function coursSubForm()
        {
            $user = auth()->user();
            $formation = Formation::where('id', $user->formation_id)->first();
            $subscribedCours = $user->cours()->pluck('id')->toArray(); // Get IDs of subscribed courses
            $cours = $formation->cours()->whereNotIn('id', $subscribedCours)->get(); // Get all courses not already subscribed to
            return view('student.cours.sub')->with('cours', $cours);
        }
        public function coursSub(Request $request)
        {
            $user = auth()->user();
            $cours = $request->cours;
            $user->cours()->attach($cours);
            $request->session()->flash('etat', 'Cours ajouté à votre liste');
            return redirect()->route('student.page');
        }

    // STUDENT: Se désinscrire d'un cours
        public function coursUnsubForm()
        {
            $user = auth()->user();
            $cours = $user->cours()->get();
            return view('student.cours.sub')->with('cours', $cours);
        }
        public function coursUnsub(Request $request)
        {
            $user = auth()->user();
            $cours = $request->cours;
            $user->cours()->detach($cours);
            $request->session()->flash('etat', 'Cours supprimé de votre liste');
            return redirect()->route('student.page');
        }

    // STUDENT: Lister les cours
        public function coursSubList()
        {
            $user = auth()->user();
            $cours = $user->cours()->get();
            return view('student.cours.subList')->with('cours', $cours);
        }

    // STUDENT: Recherche cours
        public function coursSearchForm()
        {
            return view('student.cours.search');
        }

        public function coursSearch(Request $request)
        {
            $request->validate([
                'cours' => 'required|string|max:30',
            ]);

            $user = auth()->user();
            $formation = Formation::where('id', $user->formation_id)->first();
            $cours = Cours::where('intitule', 'LIKE', "%{$request->cours}%")->where('formation_id', "=", $formation->id)->get();
            return view('student.cours.searchResult')->with('cours', $cours);
        }
    

    
}
