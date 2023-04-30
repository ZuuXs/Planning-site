@extends('app')

@section('title','Changement de nom/prenom')

@section('contents')
<form method="post">
    <label for="nom">Nom : </label>
    <input type="text" name="nom"><br>

    <label for="Prenom"> Prenom :</label>
    <input type="text" name="prenom">

    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection