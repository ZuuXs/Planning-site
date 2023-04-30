<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cours;
use App\Models\Formation;
use App\Models\User;
use App\Models\Planning;
use Carbon\Carbon;



class PlanningController extends Controller
{
    // PROF: Créer une seance de cours
        public function createSeanceForm()
        {
            $u=Auth::user();
            return view('prof.planning.seance.create')->with('user', $u);
        }

        public function createSeance(Request $request)
        {
            $request->validate([
                'cours' => 'required',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
            ]);
            $p = new Planning();
            $p->date_debut = $request->date_debut;
            $p->date_fin = $request->date_fin;
            $p->cours_id = $request->cours;
            $p->save();
            $request->session()->flash('etat', 'La séance a été créée avec succès');
            if(Auth::user()->type == 'enseignant') return redirect()->route('prof.page');
            else return redirect()->route('admin.page');
        }

    // STUDENT: Affiche le planning
        public function display()
        {
            return view('student.planning.display')->with('cours', auth()->user()->cours);
        }
    
    
        public function planningSearchForm(Request $request)
        {
            $u = auth()->user();
            $cours = $u->cours;

            if ($request->has('week')) {
                preg_match('/W\d+/', $request->input('week'), $weekMatches);
                preg_match('/\d+\-/', $request->input('week'), $yearMatches);
                if (!isset($weekMatches[0]) || !isset($yearMatches[0])) {
                    // Display an error message if week is not entered
                    $request->session()->flash('error', 'Veuillez entrer une semaine valide');
                }else{

                
                    $week = preg_replace('/W/', '', $weekMatches[0]);
                    $year = preg_replace('/\-/', '', $yearMatches[0]);
                    $weekDate = Carbon::now()->setISODate($year, $week);
                    $startOfWeek = $weekDate->startOfWeek()->toDateString();
                    $endOfWeek = $weekDate->endOfWeek()->toDateString();

                    $cours = $u->cours()->whereHas('plannings', function ($q) use ($startOfWeek, $endOfWeek) {
                        $q->whereDate('date_debut', '>=', $startOfWeek)->whereDate('date_fin', '<=', $endOfWeek);
                    })->get();
                }

            }
            return view('student.planning.display')->with('cours', $cours);
        }

    // STUDENT: rechercher un planning par cours
        public function planningSearchByCoursForm()
        {
            $user = auth()->user();
            $cours = $user->cours()->get();
            return view('student.planning.searchByCours')->with('cours', $cours);
        }
        public function planningSearchByCours(Request $request)
        {
            $request->validate([
                'cours' => 'required',
            ]);
            $cours = Cours::find($request->cours);
            return view('student.planning.searchByCoursResult')->with('cours', $cours);
        }

    // PROF: Mettre a jour une seance de cours avec filtrage par semaine
        public function editSeanceForm(Request $request)
        {
            $u = auth()->user();
            $cours = $u->cours;

            if ($request->has('week')) {
                preg_match('/W\d+/', $request->input('week'), $weekMatches);
                preg_match('/\d+\-/', $request->input('week'), $yearMatches);
                if (!isset($weekMatches[0]) || !isset($yearMatches[0])) {
                    // Display an error message if week is not entered
                    $request->session()->flash('error', 'Veuillez entrer une semaine valide');
                }else{
                    $week = preg_replace('/W/', '', $weekMatches[0]);
                    $year = preg_replace('/\-/', '', $yearMatches[0]);
                    $weekDate = Carbon::now()->setISODate($year, $week);
                    $startOfWeek = $weekDate->startOfWeek()->toDateString();
                    $endOfWeek = $weekDate->endOfWeek()->toDateString();

                    $cours = $u->cours()->whereHas('plannings', function ($q) use ($startOfWeek, $endOfWeek) {
                        $q->whereDate('date_debut', '>=', $startOfWeek)->whereDate('date_fin', '<=', $endOfWeek);
                    })->get();
                }
            }
            return view('prof.planning.seance.editList')->with('cours', $cours);
        }

        public function editSeance(Request $request)
        {

            $request->validate([
                'planning' => 'required',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
            ]);

            $planning = Planning::find($request->planning);

            $planning->date_debut = $request->date_debut;
            $planning->date_fin = $request->date_fin;
            $planning->save();

            $request->session()->flash('etat', 'La séance a été modifiée avec succès');
            return back();
        }

    //PROF: Mettre a jour une seance de cours avec filtrage par cours
        public function editSeanceByCoursForm()
        {
            $user = auth()->user();
            $cours = $user->cours()->get();
            return view('student.planning.searchByCours')->with('cours', $cours);
        }

        public function editSeanceByCours(Request $request)
        {
            $request ->validate([
                'cours'=>'required',
            ]);

            $cours = Cours::find($request->cours);
            return view('prof.planning.seance.editListByCours')->with('cours', $cours);
        }
    
    //PROF: Supprimer une séance
        public function delSeance(Request $request)
        {
            $request->validate([
                'planning' => 'required',
            ]);
            $planning = Planning::find($request->planning);
            $planning->delete();
            $request->session()->flash('etat', 'La séance a été supprimée avec succès');
            return back();
        }


    //ADMIN: Creer une seance pour un prof
        public function createSeanceAdminForm(Request $request)
        {
            $request->validate([
                'prof' => 'required',
            ]);

            $prof= User::find($request->prof);
            return view('admin.planning.seance.add')->with('prof', $prof);
        }

    //ADMIN: Mettre a jour une seance par seamaine
        public function editSeanceAdminForm(Request $request)
        {
            $profs = User::where('type', 'enseignant')->get();

            if ($request->has('week')) {
                preg_match('/W\d+/', $request->input('week'), $weekMatches);
                preg_match('/\d+\-/', $request->input('week'), $yearMatches);
                if (!isset($weekMatches[0]) || !isset($yearMatches[0])) {
                    // Display an error message if week is not entered
                    $request->session()->flash('error', 'Veuillez entrer une semaine valide');
                }else{
                    $week = preg_replace('/W/', '', $weekMatches[0]);
                    $year = preg_replace('/\-/', '', $yearMatches[0]);
                    $weekDate = Carbon::now()->setISODate($year, $week);
                    $startOfWeek = $weekDate->startOfWeek()->toDateString();
                    $endOfWeek = $weekDate->endOfWeek()->toDateString();

                    $profs = $profs->each(function ($prof) use ($startOfWeek, $endOfWeek) {
                        $prof->cours = $prof->cours->filter(function ($cour) use ($startOfWeek, $endOfWeek) {
                            return $cour->plannings->where('date_debut', '>=', $startOfWeek)->where('date_fin', '<=', $endOfWeek)->count() > 0;
                        });
                    });
                }
            }
            return view('admin.planning.seance.editList')->with('profs', $profs);
        }

    //ADMIN: Mettre a jour une seance par cours
        public function editSeanceAdminByCoursForm()
        {
            $cours = Cours::all();
            return view('student.planning.searchByCours')->with('cours', $cours);
        }

}