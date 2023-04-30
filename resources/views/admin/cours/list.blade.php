@extends('app')

@section('title','Liste des cours')

@section('contents')
<div class="container">
    <div class="table_prof">
        <h2>Liste des cours</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Intitulé</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                @foreach($cours as $cours)
                <tr>
                    <td>{{$cours['id']}} </td>
                    <td>{{$cours['intitule']}} </td>
                    <td><ul>
                            <li><form method="POST" action="{{route('cours.maj')}}">
                                @csrf
                                <input value="{{ $cours->id }}" name="cours" type="hidden"></input>
                                <label for="intitule"> Intitulé :</label>
                                <input type="texte" id="fprenom" name="intitule">
                                <button type="submit">Modifier</button><br>
                                </form></li>
                            <li><form method="POST" action="{{route('cours.maj')}}">
                                @csrf
                                <input value="{{ $cours->id }}" name="cours" type="hidden"></input>
                                <label for="formation">Enseingant :</label>
                                <select name="prof" >
                                @foreach($profs as $prof)
                                    <option value="{{ $prof->id }}">{{ $prof->nom }}</option>
                                @endforeach
                                </select>
                                <button type="submit">Modifier</button><br>
                                </form>
                            </li>
                            <li><form method="POST" action="{{route('cours.maj')}}">
                                @csrf
                                <input value="{{ $cours->id }}" name="cours" type="hidden"></input>
                                <label for="formation">Formation :</label>
                                <select name="formation">
                                @foreach($formations as $formation)
                                    <option value="{{ $formation->id }}">{{ $formation->intitule }}</option>
                                @endforeach
                                </select>
                                <button type="submit">Modifier</button><br>
                                </form>
                            </li>
                        </ul>
                    </td>
                    <td><ul>
                            <li><form method="POST" action="{{route('cours.del')}}">
                                @csrf
                                <input value="{{ $cours->id }}" name="cours" type="hidden"></input>
                                <button type="submit">Supprimer</button><br>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection