@extends('app')

@section('title','Student')

@section('contents')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Étudiant
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{route('cours.list_formations')}}"><i class="fas fa-book"></i>Voir la liste des cours de votre formation</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('student.sub')}}"><i class="fas fa-user-plus"></i>S'inscrire dans un cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('student.unsub')}}"><i class="fas fa-user-minus"></i>Se désinscrire d'un cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('student.cours.subList')}}"><i class="fas fa-list"></i>Liste des cours inscrits</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('cours.search')}}"><i class="fas fa-search"></i>Rechercher un cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('student.planning')}}"><i class="fas fa-calendar-alt"></i>Voir le planning</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('planning.cours')}}"><i class="fas fa-calendar-check"></i>Voir le planning par cours</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection