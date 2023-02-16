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
        {{-- <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
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
                        <p class="navbar-text">Rol: <span class="infosesion">{{ Auth::user()->tipo }}</span></p>
                        <p class="navbar-text">Sesión: <span class="infosesion">{{session('hora')}}</span></p>
                    </div>
                    <li class="botonesCabecera"><a href="{{ route('logout') }}" id="logout"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                </ul>
            </div>
        </nav> --}}


        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h6 class="navbar-brand text-white-50 fw-bold">Nosecaen S.L.</h6>
                </div>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto botonesCabecera">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn linkhead" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class=" linkhead"><i class="bi bi-list-task"></i> Tareas</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item btn" href="{{ route('tarea.index') }}"><i class="bi bi-card-list"></i> Ver Tareas</a>
                        @if(Auth::user()->tipo == 'administrador')
                        <a class="dropdown-item btn" href="{{ route('tarea.create') }}"><i class="bi bi-clipboard2-plus"></i> Añadir Tarea</a>
                        <a class="dropdown-item btn" href="{{ route('tarea.pendientes') }}"><i class="bi bi-clock-history"></i> Tareas Pendientes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item btn" href="{{ route('tarea.incidencias') }}"><i class="bi bi-file-earmark-arrow-up"></i> Incidencias</a>
                        @endif
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn linkhead" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="linkhead"><i class="bi bi-people"></i> Usuarios</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                        @if(Auth::user()->tipo == 'administrador')
                        <a class="dropdown-item btn" href="{{ route('usuario.index') }}"><i class="bi bi-person-lines-fill"></i> Listar Usuarios</a>
                        <a class="dropdown-item btn" href="{{ route('usuario.create') }}"><i class="bi bi-person-plus"></i> Añadir Usuario</a>
                        <div class="dropdown-divider"></div>
                        @endif
                        <a class="dropdown-item btn" href="{{ route('usuario.show', Auth::user()->id) }}"><i class="bi bi-person-circle"></i> Mi Usuario</a>
                    </div>
                  </li>
                  @if(Auth::user()->tipo == 'administrador')
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn  linkhead" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="linkhead"><i class="bi bi-wallet-fill"></i> Clientes</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item btn" href="{{ route('cliente.index') }}"><i class="bi bi-person-vcard"></i> Listar Clientes</a>
                        <a class="dropdown-item btn" href="{{ route('cliente.create') }}"><i class="bi bi-person-plus-fill"></i> Añadir Cliente</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn linkhead" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="linkhead"><i class="bi bi-journals"></i> Cuotas</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                        <a class="dropdown-item btn" href="{{ route('cuota.crearRemesa') }}"><i class="bi bi-journal-plus"></i> Añadir Remesa</a>
                    </div>
                  </li>
                  {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li> --}}
                  @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <div id="sesion">
                        <p class="navbar-text">Bienvenido, <span class="infosesion">{{ Auth::user()->name }}</span></p>
                        <p class="navbar-text">Rol: <span class="infosesion">{{ Auth::user()->tipo }}</span></p>
                        <p class="navbar-text">Sesión: <span class="infosesion">{{session('hora')}}</span></p>
                    </div>
                    <li class="botonesCabecera nav-item"><a href="{{ route('logout') }}" id="logout" class="nav-link btn"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                </ul>
              </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";

        $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
        });
    </script>
</body>

</html>