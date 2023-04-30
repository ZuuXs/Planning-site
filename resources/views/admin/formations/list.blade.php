@extends('app')

@section('title','Liste des formations')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Liste des formations</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Intitulé</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                @foreach($formations as $formation)
                    <tr>
                        <td>{{$formation['id']}} </td>
                        <td>{{$formation['intitule']}} </td>
                        <td><form method="POST" action="{{route('formation.maj')}}">
                            @csrf
                                <input value="{{ $formation->id }}" name="formation" type="hidden"></input>
                                <label for="intitule">Intitulé :</label>
                                <input type="texte" id="fprenom" name="intitule">
                                <button type="submit">Modifier</button><br>
                            </form>
                        </td>
                        <td><form method="POST" action="{{route('formation.del')}}">
                            @csrf
                                <input value="{{$formation->id }}" name="formation" type="hidden"></input>
                                <button type="submit">Supprimer</button><br>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tr>
        </table>
    </div>
</div>
@endsection