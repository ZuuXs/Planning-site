@extends('app')

@section('title','Validation des utilisateurs')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Demande Enseignant</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Operation</th>
                @foreach($profs as $prof)
            <tr>
                <td>{{$prof['nom']}} </td>
                <td>{{$prof['prenom']}} </td>

                <td>
                    <form method="post" action="{{route('prof.validation')}}">
                        @csrf
                        <input type="hidden" value="{{ $prof['id'] }}" name="ut_id">
                        <button type="submit">Accepter</button>
                    </form>
                    <form method="post" action="{{route('user.decline')}}">
                        @csrf
                        <input type="hidden" value="{{ $prof['id'] }}" name="ut_id">
                        <button type="submit">Refuser</button>
                </td>
                </form>
                </td>
            </tr>
            @endforeach

            </tr>
        </table>
    </div>
    <div class="table_etudiants">
        <h2>Demandes Etudiant</h2>

        <table>
            <tr>
                <th>Nom</th>
                <th>prenom</th>

                <th>Operation</th>
                @foreach($students as $student)
            <tr>
                <td>{{$student['nom']}} </td>
                <td>{{$student['prenom']}} </td>


                <td>
                    <form method="post" action="{{route('student.validation')}}">
                        @csrf
                        <input type="hidden" value="{{ $student['id'] }}" name="ut_id">
                        <button type="submit">Accepter</button>
                    </form>
                    <form method="post" action="{{route('user.decline')}}">
                        @csrf
                        <input type="hidden" value="{{ $student['id'] }}" name="ut_id">
                        <button type="submit">Refuser</button>
                </td>
                </form>
            </tr>
            @endforeach

            </tr>
        </table>
    </div>
</div>

<style>
    .container {
        display: flex;
        width: 100%;
    }

    .container>* {
        flex-basis: 50%;
        padding: 0 1em;
    }
</style>

@endsection