@extends('app')

@section('title','Settings')

@section('contents')
<ol class="list-group">
    <li class="list-group-item">
        <a href="{{route('user.edit_password')}}"><i class="fas fa-lock"></i> Modifier le mot de passe</a>
    </li>
    <li class="list-group-item">
        <a href="{{route('user.edit_name')}}"><i class="fas fa-user"></i> Modifier le Nom/Prenom </a>
    </li>
</ol>


@endsection