<?php
// session_start();
// if ($_SESSION['idx_dentro'] == false || $_SESSION['tipo'] == 'operario') {
//     session_unset(); // Libera todas las variables de sesión
//     session_destroy(); // Destruimos la sesión
//     header('Location: index.php?controller=login&action=login');
//     // Finalizamos script
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosecaen S.L.</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('assets/css/plantilla.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/inicioVista.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/nuevaTarea.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/verTareas.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/eliminarTarea.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/verTareasBuscadas.css')}}">
</head>

<body>
    <header class="bg-dark text-center text-white">
        <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
            <div class="navbar-header">
                <h6 class="navbar-brand">Nosecaen S.L.</h6>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto botonesCabecera">
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('tarea.index') }}" role="button"><i class="bi bi-list-task"></i> Ver Tareas</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('tarea.create') }}" role="button"><i class="bi bi-clipboard2-plus"></i> Añadir Tarea</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('tarea.pendientes') }}" role="button"><i class="bi bi-clock-history"></i> Tareas Pendientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('tarea.incidencias') }}" role="button"><i class="bi bi-journal-arrow-up"></i> Incidencias</a>
                    </li>
                    <li class="nav-item separador">|</li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('usuario.index') }}" role="button"><i class="bi bi-person-lines-fill"></i> Listar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('usuario.create') }}" role="button"><i class="bi bi-person-plus"></i> Añadir Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="" role="button"><i class="bi bi-person-circle"></i> Mi Usuario</a>
                    </li>
                    <li class="nav-item separador">|</li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('cliente.index') }}" role="button"><i class="bi bi-person-vcard"></i> Listar Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('cliente.create') }}" role="button"><i class="bi bi-person-plus-fill"></i> Añadir Cliente</a>
                    </li>
                    <li class="nav-item separador">|</li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="{{ route('cuota.crearRemesa') }}" role="button"><i class="bi bi-journal-plus"></i> Añadir Remesa</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <div id="sesion">
                        <p class="navbar-text">Bienvenido, <span class="infosesion">{{ Auth::user()->name }}</span></p>
                        {{-- <p class="navbar-text">Rol: <span class="infosesion">{{$sesion["tipo"]}}</span></p>
                        <p class="navbar-text">Sesión: <span class="infosesion">{{$sesion["hora"]}}</span></p> --}}
                    </div>
                    <li class="botonesCabecera"><a href="{{ route('logout') }}" id="logout"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                </ul>
            </div>
        </nav>
    </header>

    @yield('cuerpo')

    <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                SiempreColgados
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 David Pérez Borrero
        </div>
        <!-- Copyright -->
    </footer>

</body>

</html>