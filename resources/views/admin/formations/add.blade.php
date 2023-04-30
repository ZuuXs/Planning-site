@extends('app')

@section('title','Créer une formation')

@section('contents')
<p>Création d'une formation</p>
<form method="post">
    <label for="fnom">Intitulé :</label>
    <input type="text" name="nom" value="{{ old('nom') }}">

    <input type="submit" value="Créer">
    @csrf
</form>
@endsection