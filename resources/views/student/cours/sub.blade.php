@extends('app')

@section('title','Inscription')

@section('contents')
<p>Choisissez le cours</p>
<form method="post">
    <label for="Cours" >Cours </label>

    <select name="cours">
        @foreach($cours as $cour)
        <option value="{{ $cour->id }}">{{ $cour->intitule }}</option>
        @endforeach
    </select>
    </br>

    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection