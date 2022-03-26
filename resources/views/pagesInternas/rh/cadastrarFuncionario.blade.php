@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Cadastro de Funcionários')

@section('header')
	<div class="row">
		<div class="col bg-light text-dark text-center p-2 mb-3 mx-3 border">
			<b>Cadastro de Funcionário</b>
		</div>
	</div>
@endsection

@section('content')

<div class="row">
	<div class="col">
		<form id="form-Validation" novalidate method="POST">
        @csrf

         @if(session('msgSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('msgSuccess')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

  	<div class="card">
	  <div class="card-header text-center">
	    <b>Dados Pessoais</b>
	  </div>
	  <div class="card-body">

	    <div class="row">
            <div class="col-md-4">
              <label for="nome" class="form-label">Nome</label>
              <input 
              type="text"
              name="name"
              value="{{old('name')}}" 
              class="form-control @error('name') is-invalid @enderror" 
              id="nome" 
              placeholder="" 
              autocomplete="off"
              required       
              >
              <div class="invalid-feedback">
                Preenchimento obrigatório.
              </div>
            </div>

            <div class="col-md-4">
              <label for="cpf" class="form-label">CPF</label>
              <input 
              type="cpf"
              name="cpf"
              value="{{old('cpf')}}" 
              class="form-control @error('cpf') is-invalid @enderror" 
              id="cpf" 
              placeholder="___.___.___-__" 
              autocomplete="off"
              required       
              >
              <div class="invalid-feedback">
                Preenchimento obrigatório.
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-4">
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

            <div class="col-md-4">
              <label for="celular" class="form-label">Celular</label>
              <input 
              type="text"
              name="celular"
              value="{{old('celular')}}" 
              class="form-control @error('celular') is-invalid @enderror" 
              id="celular" 
              placeholder="(__)_____-____" 
              autocomplete="off"
              required       
              >
              <div class="invalid-feedback">
                Preenchimento obrigatório.
              </div>
            </div>
          </div>

	  </div>
	</div>

	<div class="card mt-3">
	  <div class="card-header text-center">
	    <b>Cargo</b>
	  </div>
	  <div class="card-body">
	    <select name="cargo_setor" class="form-select @error('cargo_setor') is-invalid @enderror" aria-label="Default select example" required>
		  <option value="">Selecione o cargo...</option>
		  <option @if(old('cargo_setor') == 1)selected @endif value="1">Recepcionista (setor: Recepção)</option>
		  <option @if(old('cargo_setor') == 2)selected @endif value="2">Analista de RH (setor: RH)</option>
		  <option @if(old('cargo_setor') == 3)selected @endif value="3">Enfermeiro (setor: Enfermagem)</option>
		  <option @if(old('cargo_setor') == 4)selected @endif value="4">Técnico em enfermagem (setor: Enfermagem)</option>
		  <option @if(old('cargo_setor') == 5)selected @endif value="5">Médico clínico geral (setor: Medicina)</option>
		  <option @if(old('cargo_setor') == 6)selected @endif value="6">Médico cirugião geral (setor: Medicina)</option>
		</select>
	  </div>
	</div>

	<button class="btn btn-info mt-3" type="submit">Cadastar</button>

    </form>
	</div>
</div>
@endsection

@section('js')

	<script src="{{ asset('js/jquery.mask.js') }}"></script>

	<script type="text/javascript">
        
        $(document).ready(function(){
            $('#celular').mask('(00)00000-0000');
        });

        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
        });
        
    </script>

    

@endsection