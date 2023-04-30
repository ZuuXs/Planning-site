@extends('app')

@section('title','Modification du mot de passe')

@section('contents')
<h1>Modifier votre mot de passe</h1>
<form method="post">

    Ancien: <input type="password" name="old_mdp"></p>

    Nouveau: <input type="password" id="fmdp" name="mdp"></p>

    Confirmation du nouveau: <input type="password" id="fcmdp" name="mdp_confirmation"></p>

    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection