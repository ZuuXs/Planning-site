@extends('app')

@section('title','Resultat de la recherche de cours')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Cours</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Intitulé</th>
                @foreach($cours as $cour)    
                    <tr>
                        <td>{{$cour['id']}} </td>
                        <td>{{$cour['intitule']}} </td>
                    </tr>
                @endforeach
            </tr>
        </table>
    </div>
</div>
@endsection

