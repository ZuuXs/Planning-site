@extends('app')

@section('title','Resultat de la recherche par cours')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Planning</h2>
        <table>
            <tr>
                <th>Cours</th>
                <th>Date du cours</th>
            </tr>
            <tr>
                <td>{{ $cours['intitule'] }}</td>
                <td>
                    <ul>
                        @foreach($cours->plannings as $planning)
                        <li>
                            <div>{{$planning['intitule']}} </div>
                            <div>Date debut : {{$planning['date_debut']}} </div>
                            <div>Date fin : {{$planning['date_fin']}} </div>
                        </li>
                        <br />
                        @endforeach
                    </ul>
                </td>
            </tr>

        </table>
    </div>
</div>
@endsection