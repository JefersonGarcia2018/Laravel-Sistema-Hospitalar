<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>@yield('title') - Sistema Hospitalar</title>

    <link rel="canonical" href="">
    <link rel="Sistema Hospitalar icon" type="imagex/png" href="{{asset('img/logo/hospital-icon-vector01.ico')}}">

    

    <!-- Bootstrap core CSS -->
    <link href="{{asset('site/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{asset('css/layoutExterno.css')}}" rel="stylesheet">
    @yield('css')
  </head>


  <body>
    
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check" viewBox="0 0 16 16">
    <title>Check</title>
    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  </symbol>
</svg>

<div class="container py-3">

  <header class="d-print-none">

    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="{{route('/')}}" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="{{asset('img/logo/hospital-icon-vector.png')}}" alt="" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img">
        <span class="fs-4">Sistema Hospitalar</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark " href="{{route('/')}}">Home</a>
        @can('rh')
        <a class="me-3 py-2 text-dark" href="{{route('cadastrar-funcionario')}}">Cadastrar Funcionário</a>
        <a class="me-3 py-2 text-dark" href="{{route('pesquisar-funcionario')}}">Pesquisar Funcionário</a>
        @endcan
        @can('recepcao')
        <a class="me-3 py-2 text-dark" href="{{route('internar-paciente')}}">Internação</a>
        <a class="me-3 py-2 text-dark" href="{{route('recepcao-pesquisar-paciente')}}">Pesquisar Paciente</a>
        @endcan
        @can('enfermagem')
        <a class="me-3 py-2 text-dark" href="{{route('lista-pacientes-enfermagem')}}">Pacientes</a>
        <a class="me-3 py-2 text-dark" href="{{route('enfermagem-pesquisar-paciente')}}">Pesquisar Paciente</a>
        @endcan
        @can('medicina')
        <a class="me-3 py-2 text-dark" href="{{route('lista-pacientes')}}">Pacientes</a>
        <a class="me-3 py-2 text-dark" href="{{route('medicina-pesquisar-paciente')}}">Pesquisar Paciente</a>
        @endcan
        
        <div class="dropdown pr-3">
          <a class="btn btn-success dropdown-toggle" id="bd-versions" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
          </svg>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-versions">
            <li><span class="dropdown-item current" aria-current="true">{{Auth::user()->name}}</span></li>
            <li><hr class="dropdown-divider"></li>
            <li><span class="dropdown-item current" aria-current="true"><b>Setor:</b> {{Auth::user()->setor}}</span></li>
            <li><span class="dropdown-item current" aria-current="true"><b>Cargo:</b> {{Auth::user()->cargo}}</span></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item" href="{{route('configuracoes')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                  <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                </svg>
            Configuração
            </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item" href="{{route('logout')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
              </svg>
          Sair
          </a>
          </li>
          </ul>
        </div><!-- /div dropdown -->
      </nav>
    </div>

    @yield('header')

  </header>


  <main>

    @yield('content')

  </main>

</div>

  
  <script type="" src="{{asset('site/jquery.js')}}"></script>
  <script type="" src="{{asset('site/bootstrap.bundle.min.js')}}"></script>
  

  @yield('js')
  
  </body>
</html>
