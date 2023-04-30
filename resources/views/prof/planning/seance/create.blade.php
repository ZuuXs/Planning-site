@extends('app')

@section('title','Créer une séance de cours')

@section('contents')
<p>Créer une séance de cours</p>
<form method="post" action="{{route('create.seanceP')}}">
    <label for="cours" >Cours :</label>
    <select name="cours">
        @foreach($user->cours()->get() as $cour)
        <option value="{{ $cour->id }}">{{ $cour->intitule }}</option>
        @endforeach
    </select><br>
    <label for="date_debut">Date de début :</label>
    <input type="datetime-local" id="fprenom" name="date_debut"><br>
    <label for="date_fin">Date de fin :</label>
    <input type="datetime-local" id="flogin" name="date_fin"><br>
    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection