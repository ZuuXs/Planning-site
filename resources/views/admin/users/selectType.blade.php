@extends('app')

@section('title','Recherche d'utilisateurs par type')

@section('contents')
<p>Choisir un type</p>
<form method="post">
    <label for="type">Type:</label>
    <select name="type">
        <option value="enseignant">Professeur</option>
        <option value="etudiant">Etudiant</option>
        <option value="admin">Administrateur</option>
    </select>
    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection