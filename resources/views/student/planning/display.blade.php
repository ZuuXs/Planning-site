@extends('app')

@section('title','Planning')

@section('contents')
<div class="container">
    <div class="table_prof">

        <h2>Planning</h2>
        <p>
            Choisissez un numéro d'une semaine pour filtrer
        </p>
        <form method="GET" action="{{ route('planning.search') }}">
            Week <input type="week" name="week">
            <button type="submit">Filter</button>
        </form>
        <table>
            <tr>
                <th>Cours</th>
                <th>Date du cours</th>
            </tr>
            @if($cours)
                @foreach($cours as $cour)
                    <tr>
                        <td>{{ $cour['intitule'] }}</td>
                        <td>
                            <ul>
                                @foreach($cour->plannings as $planning)
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
                @endforeach
            @else
                <tr>
                    <td colspan="2">No courses found.</td>
                </tr>
            @endif
        </table>
    </div>
</div>
@endsection