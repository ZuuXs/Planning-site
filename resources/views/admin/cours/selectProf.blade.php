@extends('app')

@section('title','Recherche de cours par prof')

@section('contents')
    <p>Choisissez un enseignant</p>
    <form method="post">
        <label for="Prof" >Enseignant</label>

        <select name="prof">
            @foreach($profs as $prof)
                <option value="{{ $prof->id }}">{{ $prof->nom }}</option>
            @endforeach
        </select>
        </br>

        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection


