@extends('app')

@section('title','Résultat de la recherche de cours')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Liste des cours</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Intitulé</th>
                @foreach($cours as $cour)
                    <tr>
                        <td>{{$cour['id']}} </td>
                        <td>{{$cour['intitule']}} </td>
                @endforeach

        </table>
    </div>
</div>
@endsection