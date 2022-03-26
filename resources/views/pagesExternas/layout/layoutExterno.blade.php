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

  <header>

    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="{{route('/')}}" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="{{asset('img/logo/hospital-icon-vector.png')}}" alt="" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img">
        <span class="fs-4">Sistema Hospitalar</span>
      </a>
    </div>

    @yield('header')

  </header>


  <main>

    @yield('content')

  </main>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <img class="mb-2" src="{{asset('img/logo/hospital-icon-vector.png')}}" alt="" width="24" height="19"> Sistema Hospitalar
        <small class="d-block mb-3 text-muted">&copy; 2022</small>
      </div>
      <div class="col-6 col-md">
        <h5>Recursos</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="{{route('sobre')}}">Sobre o Site</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="{{route('servicos')}}">Serviços</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="{{route('contatos')}}">Contatos</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Recursos</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Recurso</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Nome do recurso</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Outro recurso</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Recurso final</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Recursos</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Equipe</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Localização</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Privacidade</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Termos</a></li>
        </ul>
      </div>
    </div>
  </footer>

</div>

  
  
  <script type="" src="{{asset('site/bootstrap.bundle.min.js')}}"></script>

  @yield('js')
  
  </body>
</html>
