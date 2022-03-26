@extends('pagesExternas.layout.layoutExterno')

@section('title', 'Home')

@section('header')
  <div class="p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal text-success">Sobre o Sistema</h1>
      <div class="fs-5 text-muted text-start">
        <ul>
          <li>Cadastro/internação de pacientes.</li>
          <li>Cadastro de funcionários dos seguinte setores: RH, recepção, enfermagem e medicina.</li>
          <li>Possui a funcionalidade de relatórios de enfermagem.</li>
          <li>Possui as funcionalidades de prescrição e relatórios médicos.</li>
        </ul>
      </div>
  </div>
@endsection

@section('content')

  <div class="row row-cols-1 row-cols-md-2 mb-3 text-center justify-content-center">

      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3 bg-success bg-gradient text-white">
            <h4 class="my-0 fw-normal">Login</h4>
          </div>
          <div class="card-body">
      
      <form id="form-Validation" class="text-start" novalidate method="POST" action="{{route('login')}}">
        @csrf

          @if(session('danger'))
            <div class="col alert alert-danger alert-dismissible fade show" role="alert">
              {{session('danger')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
              
            </div>
          @endif

          <div class="row">
            <div class="col">
              <label for="email" class="form-label">Email</label>
              <input 
              type="email"
              name="email"
              value="{{old('email')}}" 
              class="form-control @error('email') is-invalid @enderror" 
              id="email" 
              placeholder="" 
              autocomplete="off"
              required       
              >
              <div class="invalid-feedback">
                Preenchimento obrigatório.
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <label for="password" class="form-label">Senha</label>
              <input 
              type="password"
              name="password"
              value="{{old('password')}}" 
              class="form-control @error('password') is-invalid @enderror" 
              id="password" 
              placeholder="" 
              class="@error('password') is-invalid @enderror"
              required 
              >
              <div class="invalid-feedback">
                Preenchimento obrigatório
              </div>
            </div>
          </div>
            <button type="submit" class="w-100 btn btn-lg btn-outline-success mt-3">Entrar</button>
          </form>
          </div>
        </div>
      </div>

    </div>

@endsection

@section('js')
<script src="{{asset('js/form-validation.js')}}"></script>
@endsection