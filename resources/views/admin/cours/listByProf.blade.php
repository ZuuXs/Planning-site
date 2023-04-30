@extends('app')

@section('title','Resultat de la recherche de cours par prof')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Liste des cours de {{$prof->nom}} {{$prof->prenom}}</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Intitulé</th>
                @foreach($cours as $cour)
                    <tr>
                        <td>{{$cour['id']}} </td>
                        <td>{{$cour['intitule']}} </td>
                    </tr>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection