@extends('app')

@section('title','Enseignant')

@section('contents')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                Enseignant
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{route('cours.list_prof')}}"><i class="fas fa-book"></i> Voir la liste de vos cours</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('create.seance')}}"><i class="fas fa-calendar-plus"></i>Créer une séance</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('prof.seance.maj')}}"><i class="fas fa-calendar-alt"></i>Liste de séances (Integrale\Semaine)</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('prof.seance.maj.byCours')}}"><i class="fas fa-calendar-check"></i>Liste de séances triées par cours </a>
                    </li>
                </ul>
          </div>
        </div>
    </div>
</div>

@endsection