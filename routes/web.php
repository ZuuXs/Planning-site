<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoggedController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PlanningController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
})->name('main');


Route::view('/Home', 'home')->middleware('auth')->name('home');
//LOGIN/LOGOUT
Route::get('/Login', [LoggedController::class, 'formLogin'])
    ->name('login');
Route::post('/Login', [LoggedController::class, 'login']);

Route::get('/Logout', [LoggedController::class, 'logout'])
    ->middleware('auth')->name('logout');

//Register Professor
Route::get('/Register/Professor', [RegisterUserController::class, 'registerProfForm'])
    ->name('register_professor');
Route::post('/Register/Professor', [RegisterUserController::class, 'registerProf']);

//Register Student
Route::get('/Register/Student', [RegisterUserController::class, 'registerStudentForm'])
    ->name('register_student');
Route::post('/Register/Student', [RegisterUserController::class, 'registerStudent']);

//USER

Route::view('/Settings', 'settings.page')->middleware('auth')->name('settings');

    //Edit password
Route::get('/Settings/Edit_Password', [UserController::class, 'editPassForm'])
    ->middleware('auth')->name('user.edit_password');
Route::post('/Settings/Edit_Password', [UserController::class, 'editPass'])
    ->middleware('auth');

    //Edit name
Route::get('/Settings/Edit_Name', [UserController::class, 'EditNameForm'])
    ->middleware('auth')->name('user.edit_name');
Route::post('/Settings/Edit_Name', [UserController::class, 'EditName'])
    ->middleware('auth')->name('edit_name');


//ADMIN

Route::view('/Admin', 'admin.page')->middleware('auth')->middleware('isAdmin')->name('admin.page');

    // List of unvalidated accounts ACCEPT/DECLINE
Route::get('/Admin/Unvalidated_accounts', [UserController::class, 'listUnvalidatedAccounts'])
    ->middleware('auth')->middleware('isAdmin');
Route::post('/Admin/Unvalidated_accounts', [UserController::class, 'validateProf'])
    ->middleware('auth')->middleware('isAdmin')->name('prof.validation');
Route::post('/Admin/Accept_student', [UserController::class, 'validateStudent'])
    ->middleware('auth')->middleware('isAdmin')->name('student.validation');
Route::post('/Admin/Decline_request', [UserController::class, 'declineAccount'])
    ->middleware('auth')->middleware('isAdmin')->name('user.decline');

    // List of professors to associate with a formation
Route::get('/Admin/Associate_prof', [UserController::class, 'profList'])
    ->middleware('auth')->middleware('isAdmin');
Route::post('/Admin/Associate_prof', [UserController::class, 'associateProf'])
    ->middleware('auth')->middleware('isAdmin')->name('prof.associate');

    // List of users
Route::get('/Admin/Users/list', [UserController::class, 'list'])
    ->middleware('auth')->middleware('isAdmin')->name('users.list');

    // List of users by type
Route::get('/Admin/Users/list_by_type', [UserController::class, 'listByTypeform'])
    ->middleware('auth')->middleware('isAdmin')->name('users.listByType');
Route::post('Admin/Users/list_by_type', [UserController::class, 'listByType'])
    ->middleware('auth')->middleware('isAdmin');

    // List of users by search
Route::get('/Admin/Users/Search', [UserController::class, 'searchForm'])
    ->middleware('auth')->middleware('isAdmin')->name('users.search');

Route::post('/Admin/Users/Search_by_nom', [UserController::class, 'searchNom'])
    ->middleware('auth')->middleware('isAdmin')->name('users.searchNom');

Route::post('/Admin/Users/Search_by_prenom', [UserController::class, 'searchPrenom'])
    ->middleware('auth')->middleware('isAdmin')->name('users.searchPrenom');

Route::post('/Admin/Users/Search_by_login', [UserController::class, 'searchLogin'])
    ->middleware('auth')->middleware('isAdmin')->name('users.searchLogin');

    // Create user
Route::get('/Admin/User/Create', [UserController::class, 'createForm'])
    ->middleware('auth')->middleware('isAdmin')->name('user.create');
Route::post('/Admin/User/Create', [UserController::class, 'create'])
    ->middleware('auth')->middleware('isAdmin');

    // Edit user
Route::get('/Admin/user/edit', [UserController::class, 'editForm'])
    ->middleware('auth')->middleware('isAdmin')->name('admin.user.edit');
Route::post('/Admin/user/edit', [UserController::class, 'edit'])
    ->middleware('auth')->middleware('isAdmin')->name('user.edit');

    // Delete user
Route::post('/Admin/user/DEL', [UserController::class, 'del'])
    ->middleware('auth')->middleware('isAdmin')->name('user.del');


    // Add cours
Route::get('/Admin/Cours/Add', [CoursController::class, 'addCoursForm'])
    ->middleware('auth')->middleware('isAdmin')->name('cours.add');
Route::post('/Admin/Cours/Add', [CoursController::class, 'addCours'])
    ->middleware('auth')->middleware('isAdmin');

    // MAJ cours
Route::post('/Admin/Cours/MAJ', [CoursController::class, 'editCours'])
    ->middleware('auth')->middleware('isAdmin')->name('cours.maj');

    // DEL cours
Route::post('/Admin/Cours/DEL', [CoursController::class, 'delCours'])
    ->middleware('auth')->middleware('isAdmin')->name('cours.del');

    // List cours
Route::get('/Admin/Cours/List', [CoursController::class, 'coursList'])
    ->middleware('auth')->middleware('isAdmin')->name('cours.list');

    // List cours by prof
Route::get('/Admin/Cours/List_by_prof', [CoursController::class, 'coursListByProfForm'])
    ->middleware('auth')->middleware('isAdmin')->name('cours.listByProf');

Route::post('/Admin/Cours/List_by_prof', [CoursController::class, 'coursListByProf'])
    ->middleware('auth')->middleware('isAdmin');

    // Recherche cours
Route::get('/Admin/Cours/Search', [CoursController::class, 'coursSearchForm'])
    ->middleware('auth')->middleware('isAdmin')->name('admin.cours.search');
Route::post('/Admin/Cours/Search', [CoursController::class, 'coursSearchAdmin'])
    ->middleware('auth')->middleware('isAdmin');




    // List formations
Route::get('/Admin/Formations/List', [FormationController::class, 'formationsList'])
    ->middleware('auth')->middleware('isAdmin')->name('formations.list');

    // Add formation
Route::get('/Admin/Formations/Add', [FormationController::class, 'addFormationForm'])
    ->middleware('auth')->middleware('isAdmin')->name('formations.add');
Route::post('/Admin/Formations/Add', [FormationController::class, 'addFormation'])
    ->middleware('auth')->middleware('isAdmin');

    // MAJ formation
Route::post('/Admin/Formations/MAJ', [FormationController::class, 'editFormation'])
    ->middleware('auth')->middleware('isAdmin')->name('formation.maj');

    // DEL formation
Route::post('/Admin/Formations/DEL', [FormationController::class, 'delFormation'])
    ->middleware('auth')->middleware('isAdmin')->name('formation.del');

    // Add seance
Route::get('/Admin/Seance/ADD', [CoursController::class, 'coursListByProfForm'])
    ->middleware('auth')->middleware('isAdmin')->name('select.prof');
Route::post('/Admin/Seance/ADD', [PlanningController::class, 'createSeanceAdminForm'])
    ->middleware('auth')->middleware('isAdmin');

    // Edit seance by weeks
Route::get('/Admin/Seance/MAJ', [PlanningController::class, 'editSeanceAdminForm'])
    ->middleware('auth')->middleware('isAdmin')->name('admin.seance.maj');

    // Edit seance by cours
Route::get('/Admin/Seance/cours', [PlanningController::class, 'editSeanceAdminByCoursForm'])
    ->middleware('auth')->middleware('isAdmin')->name('admin.seance.maj.cours');
Route::post('/Admin/Seance/cours', [PlanningController::class, 'editSeanceByCours'])
    ->middleware('auth')->middleware('isAdmin');





//PROF
Route::view('/Prof', 'prof.page')->middleware('auth')
    ->middleware('isProf')->name('prof.page');

    // Liste des cours
Route::get('/Prof/Cours/List', [CoursController::class, 'coursListProf'])
    ->middleware('auth')->middleware('isProf')->name('cours.list_prof');

    // Add Seance
Route::get('/Prof/Planning/Create_seance', [PlanningController::class, 'createSeanceForm'])
    ->middleware('auth')->middleware('isProf')->name('create.seance');
Route::post('/Prof/Planning/Create_seance', [PlanningController::class, 'createSeance'])
    ->middleware('auth')->middleware('isProf')->name('create.seanceP');

    // MAJ Seance par semaine
Route::get('/Prof/Planning/seances/MAJ', [PlanningController::class, 'editSeanceForm'])
    ->middleware('auth')->middleware('isProf')->name('prof.seance.maj');
Route::post('/Prof/Planning/seances/MAJ', [PlanningController::class, 'editSeance'])
    ->middleware('auth')->middleware('isProf')->name('seance.maj');

    // MAJ seance par cours
Route::get('/Prof/Planning/seance/MAJ', [PlanningController::class, 'editSeanceByCoursForm'])
    ->middleware('auth')->middleware('isProf')->name('prof.seance.maj.byCours');
Route::post('/Prof/Planning/seance/MAJ', [PlanningController::class, 'editSeanceByCours'])
    ->middleware('auth')->middleware('isProf');

    // Delete Seance
Route::post('/Prof/Planning/seance/DEL', [PlanningController::class, 'delSeance'])
    ->middleware('auth')->middleware('isProf')->name('seance.del');



//STUDENT
Route::view('/Student', 'student.page')->middleware('auth')
    ->middleware('isStudent')->name('student.page');

    // Liste des cours de l'étudiant
Route::get('/Student/Formation/Cours', [FormationController::class, 'coursList'])
    ->middleware('auth')->middleware('isStudent')->name('cours.list_formations');

    // Inscrire/désinscrire à un cours
Route::get('/Student/Cours/Subscription', [CoursController::class, 'coursSubForm'])
    ->middleware('auth')->middleware('isStudent')->name('student.sub');
Route::post('/Student/Cours/Subscription', [CoursController::class, 'coursSub'])
    ->middleware('auth')->middleware('isStudent');

Route::get('/Student/Cours/Unsubscription', [CoursController::class, 'coursUnsubForm'])
    ->middleware('auth')->middleware('isStudent')->name('student.unsub');
Route::post('/Student/Cours/Unsubscription', [CoursController::class, 'coursUnsub'])
    ->middleware('auth')->middleware('isStudent');

    // Liste des cours inscris
Route::get('/Student/Cours/Subbed', [CoursController::class, 'coursSubList'])
    ->middleware('auth')->middleware('isStudent')->name('student.cours.subList');

    // Rechercher un cours
Route::get('/Student/Cours/Search', [CoursController::class, 'coursSearchForm'])
    ->middleware('auth')->middleware('isStudent')->name('cours.search');
Route::post('/Student/Cours/Search', [CoursController::class, 'coursSearch'])
    ->middleware('auth')->middleware('isStudent');

    // Affiche le planning integral
Route::get('/Student/Planning', [PlanningController::class, 'display'])
    ->middleware('isStudent')->name('student.planning');
    // Affiche le planning par semaine
Route::get('/Student/Planning/search', [PlanningController::class, 'planningSearchForm'])
    ->middleware('auth')->middleware('isStudent')->name('planning.search');

    // Affiche le planning par cours
Route::get('/Student/Planning/Cours', [PlanningController::class, 'planningSearchByCoursForm']) 
    ->middleware('auth')->middleware('isStudent')->name('planning.cours'); 
Route::post('/Student/Planning/Cours', [PlanningController::class, 'planningSearchByCours']) 
    ->middleware('auth')->middleware('isStudent'); 

