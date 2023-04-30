@extends('app')

@section('title','Administrateur')

@section('contents')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Gestion des utilisateurs
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{route('prof.validation')}}"><i class="fas fa-user-check"></i>Demandes de Creation</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('user.create')}}"><i class="fas fa-user-plus"></i>Créer un utilisateur</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('users.list')}}"><i class="fas fa-users"></i>Liste des utilisateurs</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('users.listByType')}}"><i class="fas fa-users-cog"></i>Liste des utilisateurs par type</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('users.search')}}"><i class="fas fa-search"></i>Rechercher un utilisateur</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('prof.associate')}}"><i class="fas fa-chalkboard-teacher"></i>Associer un prof à un cours</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Gestion des cours
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{route('cours.list')}}"><i class="fas fa-book"></i>Liste des cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('admin.cours.search')}}"><i class="fas fa-search"></i>Rechercher un cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('cours.add')}}"><i class="fas fa-plus"></i>Créer un cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('prof.associate')}}"><i class="fas fa-chalkboard-teacher"></i>Associer un prof à un cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('cours.listByProf')}}"><i class="fas fa-user-tie"></i>Liste des cours par enseignant</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Gestion des Formations
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{route('formations.list')}}"><i class="fas fa-graduation-cap"></i>Liste des formations</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('formations.add')}}"><i class="fas fa-plus"></i>Créer une formation</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Gestion des plannings
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{route('select.prof')}}"><i class="fas fa-calendar-plus"></i>Créer une séance cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('admin.seance.maj')}}"><i class="fas fa-calendar-alt"></i>Liste de séances cours (Intégrale/Semaine)</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('admin.seance.maj.cours')}}"><i class="fas fa-calendar-alt"></i>Liste de séances cours par cours</a> 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
   

@endsection