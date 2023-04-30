@extends('app')

@section('title','Planning filtre par cours')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Planning</h2>
        <table>
            <tr>
                <th>Cours</th>
                <th>Date du cours</th>
                <th>Modifier la date du cours</th>
                <th>Supprimer une séance</th>
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
                            </li><br/>
                        @endforeach
                    </ul>
                </td>

                <td>
                    <ul>
                        @foreach($cours->plannings as $planning)
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
                            </li><br/>
                        @endforeach
                    </ul>
                </td>

                <td>
                    <ul>
                        @foreach($cours->plannings as $planning)
                            <li>
                                <form method="POST" action="{{route('seance.del')}}">
                                    @csrf
                                    <input value="{{$planning->id }}" name="planning" type="hidden"></input>
                                    <button type="submit">Supprimer</button><br>
                                </form>
                            </li><br/>
                        @endforeach
                    </ul>
                </td>
            </tr>x
        </table>
    </div>
</div>
@endsection