@extends('app')

@section('title','Resultat de la recherche d\'utilisateur')

@section('contents')
<div class="container">
    <div class="table_prof">
        <table>
            <tr>
                <th>Id</th>
                <th>nom</th>
                <th>prenom</th>
                <th>type</th>
                <th>Modifier</th>
                <th>Suppression</th>
            <tr>
                <td>{{$user['id']}} </td>
                <td>{{$user['nom']}} </td>
                <td>{{$user['prenom']}} </td>
                <td>{{$user['type']}} </td>
                <td>
                    <form method="get" action="{{route('admin.user.edit')}}">
                        @csrf
                        <input value="{{ $user->id }}" name="user" type="hidden"></input>
                        <input type="submit" value="Modifier">
                    </form>
                </td>
                <td>
                    
                    <form method="post" action="{{route('user.del')}}">
                        @csrf
                        <input value="{{$user->id }}" name="user" type="hidden"></input>
                        <button type="submit">Supprimer</button><br>
                    </form>
                </td>
            </tr>
            </tr>
        </table>
    </div>
</div>
@endsection