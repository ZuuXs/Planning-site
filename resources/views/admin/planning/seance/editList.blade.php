@extends('app')

@section('title','Planning')

@section('contents')
<div class="container">
    <div class="table_prof">
        <p>
            Choisissez un numéro d'une semaine pour filtrer
        </p>
        <form method="GET" action="{{ route('admin.seance.maj') }}">
            Week <input type="week" name="week">
            <button type="submit">Filter</button>
        </form>
        <h2>Planning</h2>
        <table>
            <tr>
                <th>Enseignant</th>
                <th>Cours et son planning</th>
                <th>Modifier un cours</th>
                <th>Suprimer un cours</th>
            </tr>
            @foreach($profs as $prof)
            <tr>
                <td>{{ $prof->nom }}</td>
                <td>
                    <ul>
                        @foreach($prof->cours as $cour)
                            <li>
                                <div>{{ $cour->intitule }}</div>
                                <ul>
                                    @foreach($cour->plannings as $planning)
                                        <li>
                                            <div>Date debut : {{$planning->date_debut}} </div>
                                            <div>Date fin : {{$planning->date_fin}} </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($prof->cours as $cour)
                            @foreach($cour->plannings as $planning)
                                <li>
                                    <form method="POST" action="{{route('seance.maj')}}">
                                        @csrf
                                        <input value="{{ $planning->id }}" name="planning" type="hidden"></input>
                                        <label for="date_debut">Date de debut :</label>
                                        <input type="datetime-local" id="fprenom" name="date_debut"><br>
                                        <label for="date_fin">Date de fin :</label>
                                        <input type="datetime-local" id="flogin" name="date_fin">
                                        <button type="submit">Modifier</button><br>
                                    </form>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($prof->cours as $cour)
                            @foreach($cour->plannings as $planning)
                                <li>
                                    <form method="POST" action="{{route('seance.del')}}">
                                        @csrf
                                        <input value="{{$planning->id }}" name="planning" type="hidden"></input>
                                        <button type="submit">Supprimer</button><br>
                                    </form>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection