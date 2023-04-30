@extends('app')

@section('title','Rechercher un utilisateur')

@section('contents')
<ul><li>
    <form method="post" action="{{route('users.searchNom')}}">
        @csrf
        <label for="nom">Nom : </label>
        <input type="text" name="nom"><br>
        <button type="submit">Rechercher Par Nom</button><br>
        </form>
    </li>
    <li>
    <form method="post" action="{{route('users.searchPrenom')}}">
        @csrf
        <label for="prenom">Prenom : </label>
        <input type="text" name="prenom"><br>
        <button type="submit">Rechercher Par Prenom</button><br>
        </form>
    </li>
    <li>
    <form method="post" action="{{route('users.searchLogin')}}">
        @csrf
        <label for="login">Login : </label>
        <input type="text" name="login"><br>
        <button type="submit">Rechercher Par Login</button><br>
        </form>
    </li>
</ul>
@endsection




