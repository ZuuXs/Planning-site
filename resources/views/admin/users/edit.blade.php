@extends('app')

@section('title','Modification d\'un utilisateur')

@section('contents')
<form method="post">
    <input type="hidden" value="{{ $user }}" name="user">

    <label for="nom">Nom : </label>
    <input type="text" name="nom"><br>

    <label for="Prenom"> Prenom :</label>
    <input type="text" name="prenom">
    <br />

    <label for="formations" >Formation :</label>

    <select name="formation" >
        @foreach($formations as $formation)
        <option value="{{ $formation->id }}">{{ $formation->intitule }}</option>
        @endforeach
        <option value={{null}}> Pas de formation </option>

    </select>
    <br />

    <label for="type" >Type:</label>

    <select name="type" >

        <option value="enseignant">enseignant</option>
        <option value="etudiant">etudiant</option>
        <option value="admin">admin</option>

    </select>

    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection