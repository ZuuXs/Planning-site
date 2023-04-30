<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cours;
use App\Models\Formation;
use App\Models\Planning;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // USER: Change password
        public function editPassForm()
        {
            return view('settings.editPassword');
        }
        public function editPass(Request $request)
        {
            $validated = $request->validate([
                'old_mdp' => 'required|string|max:60',
                'mdp' => 'required|string|max:60|confirmed'
            ]);
            $mdp_ = AUTH::User()->mdp;

            if (Hash::check($validated['old_mdp'], $mdp_)) {
                $user_id = Auth::User()->id;
                $user = User::findOrFail($user_id);
                $user->mdp = Hash::make($validated['mdp']);
                $user->save();
                $request->session()->flash('etat', 'Mot de passe changé avec succès');
                return redirect()->route('home');
            }

            $request->session()->flash('etat', 'Mot de passe incorrect');
            return redirect()->route('user.edit_password');
        }
    
    // USER: Edit profile
        public function EditNameForm()
        {
            return view('settings.editName');
        }

        public function EditName(Request $request)
        {
            $request->validate([
                'nom' => 'required|string|max:30',
                'prenom' => 'required|string|max:30',

            ]);
            $u = auth()->user();;
            $u->nom = $request->nom;
            $u->prenom = $request->prenom;
            $u->save();
            $request->session()->flash('etat', 'Nom et prénom changés avec succès');

            return redirect()->route('home');
        }


    // ADMIN: Validate account
        function listUnvalidatedAccounts()
        {

            $profs = User::where('type', null)->where('formation_id', null)->get();
            $students = User::where('type', null)->where('formation_id', '!=', null)->get();
            return view('admin.users.validation')->with('profs', $profs)->with('students', $students);
        }

        public function validateProf(Request $request)
        {
            $u = User::findOrFail($request->ut_id);
            $u->type = 'enseignant';
            $u->save();
            $request->session()->flash('etat', 'Compte validé');

            return back();
        }
        public function validateStudent(Request $request)
        {
            $u = User::findOrFail($request->ut_id);
            $u->type = 'etudiant';
            $u->save();
            $request->session()->flash('etat', 'Compte validé');

            return back();
        }

    // ADMIN: Decline account
        public function declineAccount(Request $request)
        {
            $u = User::findOrFail($request->ut_id);
            $u->delete();
            $request->session()->flash('etat', 'Compte refusé');

            return back();
        }

    //ADMIN: Associer une formation a un prof
        public function profList()
        {
            $profs = User::where('type', 'enseignant')->get();
            $cours = Cours::all();
            return view('admin.users.association')->with('profs', $profs)->with('cours', $cours);
        }

        public function associateProf(Request $request)
        {
            $u= User::findOrFail($request->prof_id);
            $c= Cours::findOrFail($request->cours_id);
            $c->user_id = $u->id;
            $c->save();
            $request->session()->flash('etat', 'Professeur associé avec succès');

            return redirect()->route('admin.page');
        }

    //ADMIN: List users
        public function list()
        {
            $users = User::where('type', '!=', null)->get();
            return view('admin.users.list')->with('users', $users);
        }

    //ADMIN: List users by type
        public function listByTypeForm()
        {
            return view('admin.users.selectType');
        }
        public function listByType(Request $request)
        {
            $users = User::where('type', $request->type)->get();
            return view('admin.users.list')->with('users', $users);
        }

    //ADMIN: Search User
        public function searchForm()
        {
            return view('admin.users.search');
        }


        public function searchNom(Request $request)
        {
            $request->validate([
                'nom' => 'required|string'
            ]);
            $user = User::where('nom', $request->nom)->first();
            if ($user == null) {
                return back()->withErrors('Le nom n\'existe pas');
            }
            return view('admin.users.searchResult')->with('user', $user);
        }

        public function searchPrenom(Request $request)
        {
            $request->validate([
                'prenom' => 'required|string'
            ]);
            $user = USER::where('prenom', $request->prenom)->first();
            if ($user == null) {
                return back()->withErrors('Le prenom n\'existe pas');
            }
            return view('admin.users.searchResult')->with('user', $user);
        }

        public function searchLogin(Request $request)
        {
            $request->validate([
                'login' => 'required|string'
            ]);
            $user = User::where('login', $request->login)->first();
            if ($user == null) {
                return back()->withErrors('Le login n\'existe pas');
            }
            return view('admin.users.searchResult')->with('user', $user);
        }


    //ADMIN: Create user
        public function createForm()
        {
            $formation = Formation::all();
            return view('admin.users.create')->with('formations', $formation);
        }

        public function create(Request $request)
        {
            $request->validate([
                'nom' => 'required|string|max:40',
                'prenom' => 'required|string|max:40',
                'login' => 'required|string|max:30|unique:users',
                'type' => 'required|string|max:30',
                'mdp' => 'required|string|confirmed|min:2|max:60',
            ]);

            if (($request->type == 'enseignant' && $request->formation != null) || ($request->type == 'etudiant' && $request->formation == null)) {
                return back()->withErrors('Veuillez choisir une formation pour un étudiant ou ne pas choisir de formation pour un enseignant');
            }

            $user = new User();
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->login = $request->login;
            $user->mdp = Hash::make($request->mdp);
            $user->type = $request->type;
            if ($request->type == 'etudiant') {
                $user->formation_id = intval($request->formation);
            }
            $user->save();
            $request->session()->flash('etat', 'Utilisateur créé avec succès');

            return redirect()->route('admin.page');
        }

    //ADMIN: Edit user
        public function editForm(Request $request)
        {
            $request->validate([
                'user' => 'required'
            ]);

            $formations = Formation::all();
            return view('admin.users.edit')->with('user', $request->user)->with('formations', $formations);
        }

        public function edit(Request $request)
        {
            $request->validate([
                'nom' => 'required|string|max:30',
                'prenom' => 'required|string|max:30',
                'type' => 'required',

            ]);
            $user = User::findOrFail($request->user);

            //si on veut changer l'utilisateur en etudiant alors on verifie si il a une formation
            if ($request->type == 'etudiant' && $request->formation == null) {
                return back()->withErrors('Veuillez choisir une formation pour un étudiant');
            };
            //si on veut changer l'utilisateur en enseignant/admin alors on verifie qu'il n'a pas de formation
            if ($request->type != 'etudiant' && $request->formation != null) {
                return back()->withErrors('Vous ne pouvez pas choisir de formation pour un enseignant/admin');
            };
        
            // Si l'utilisateur est un etudiant et qu'on veut le changer en enseignant/admin alors on supprime sa formation et ses cours
            if ($user->type == 'etudiant' && $request->type != 'etudiant') {
                $user->cours()->detach();
                $user->formation_id = null;
            }

            if($user->type=='enseignant' && $request->type!='enseignant'){
                    foreach ($user->cours as $cour) {
                        $plannings = Planning::where('cours_id', $cour->id)->get();
                        foreach ($plannings as $planning) {
                            $planning->delete();
                        }
                        $cour->delete();
                    }
            }

            // Si l'utilisateur est un enseignant/admin et qu'on veut le changer en etudiant alors on lui attribue une formation
            if($request->type=='etudiant'){
                $user->formation_id = $request->formation;
            }

            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->type = $request->type;
            $user->save();
            $request->session()->flash('etat', 'Utilisateur modifié avec succès');
            return redirect()->route('admin.page');
        }

    //ADMIN: Delete users
        public function del(Request $request)
        {
            $user = User::findOrFail($request->user);

            if($user->type == 'enseignant') {
                foreach($user->cours as $cour) {
                    $plannings = Planning::where('cours_id', $cour->id)->get();
                    foreach($plannings as $planning) {
                        $planning->delete();
                    }
                    $etudiants=$cour->users;
                    foreach($etudiants as $etudiant){
                        $etudiant->pivot->delete();
                    }
                    $cour->delete();
                }
            }
            if($user->type == 'etudiant') {
                $user->cours()->detach();
            }
            $user->delete();
            $request->session()->flash('etat', 'Utilisateur supprimé avec succès');
            return redirect()->route('admin.page');
        }





}