@extends('app')

@section('title','Connexion')

@section('contents')
<form method="post">
    <label for="flogin">Login : </label>
    <input type="text" id="flogin" name="login" value="{{old('login')}}"><br>

    <label for="fmdp"> Password :</label>
    <input type="password" id="fmdp" name="mdp">

    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection