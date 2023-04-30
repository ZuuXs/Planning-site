@extends('app')

@section('title','Associer un cours')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Associer une formation</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Associer un cours</th>
                @foreach($profs as $prof)
            <tr>
                <td>{{$prof['nom']}} </td>
                <td>{{$prof['prenom']}} </td>
                <td>
                    <form method="post" action="{{route('prof.associate')}}">
                        @csrf
                        <input type="hidden" value="{{$prof['id']}}" name="prof_id">
                        <label for="cours">Cours :</label>

                        <select name="cours_id" >
                            @foreach($cours as $cour)
                            <option value="{{$cour->id}}">{{ $cour->intitule }}</option>
                            @endforeach
                        </select>

                        <button type="submit">Associer</button>
                    </form>
                    @endforeach

            </tr>
        </table>
    </div>
</div>
@endsection