<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        body {
            background-image: url('{{ asset('img/bg.jpg') }}');
            background-size: cover;
            background-position: center center;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .etat {
            background-color: lightblue;
            padding: 10px;
            border-radius: 5px;
        }

        .error {
            background-color: lightpink;
            padding: 10px;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('main')}}">Site Planning</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @guest()
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register_professor')}}">Enregistrement en tant que enseignant</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register_student')}}">Enregistrement en tant qu'étudiant</a>
                </li>
                @endguest
                @auth
                @if(Auth::user()->type == 'etudiant')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('student.page')}}">Page Etudiant</a>
                </li>
                @endif
                @if(Auth::user()->type == 'enseignant')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('prof.page')}}">Page Enseignant</a>
                </li>
                @endif
                @if(Auth::user()->type == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.page')}}">Page Admin</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{route('settings')}}">Paramètres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Déconnexion</a>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container">
        @section('etat')
        @if(session()->has('etat'))
        <p class="etat">{{session()->get('etat')}}</p>
        @endif
        @show

        @section('errors')
        @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @show

        @yield('contents')
    </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntX5" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>