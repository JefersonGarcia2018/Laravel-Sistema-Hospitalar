@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Internar Paciente')

@section('header')
	<div class="row">
		<div class="col bg-info bg-gradient text-dark text-center p-2 mb-3 mx-3 border">
			<b>Internar Paciente</b>
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
              type="text"
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

            <div class="col-md-4">
              <label for="data_nasc" class="form-label">Data Nascimento</label>
              <input 
              type="text"
              name="data_nasc"
              value="{{old('data_nasc')}}" 
              class="form-control @error('data_nasc') is-invalid @enderror" 
              id="data_nasc" 
              placeholder="__/__/____" 
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

            <div class="col-md-4">
              <label for="radioOpcaoSexo" class="form-label">Sexo</label>
              <div id="radioOpcaoSexo" class="form-control @error('radioOpcaoSexo') is-invalid @enderror">
              
              <div class="form-check form-check-inline">
                <input 
                class="form-check-input" 
                type="radio" 
                name="radioOpcaoSexo" 
                id="radioF" 
                value="F" 
                required  
                
                @if(old('radioOpcaoSexo') == 'F')checked @endif
                >
                <label class="form-check-label" for="radioF">F</label>
              </div>

              <div class="form-check form-check-inline">
                <input 
                class="form-check-input" 
                type="radio" 
                name="radioOpcaoSexo" 
                id="radioM" 
                value="M" 
                @if(old('radioOpcaoSexo') == 'M')checked @endif
                >
                <label class="form-check-label" for="radioM">M</label>
              </div>
            </div>
            <div class="invalid-feedback">
                Preenchimento obrigatório.
              </div>
            </div>

          </div>

	  </div>
	</div>

	<div class="card mt-3">
	  <div class="card-header text-center">
	    <b>Especialidade Médica</b>
	  </div>
	  <div class="card-body">
	    <select name="especialidadeMedica" class="form-select @error('especialidadeMedica') is-invalid @enderror" aria-label="Default select example" required>
		  <option value="">Selecione a especialidade...</option>
		  <option @if(old('especialidadeMedica') == 'Clínica Geral')selected @endif value="Clínica Geral">Clínica Geral</option>
		  <option @if(old('especialidadeMedica') == 'Clínica Cirúrgica')selected @endif value="Clínica Cirúrgica">Clínica Cirúrgica</option>
		</select>
	  </div>
	</div>

	<button class="btn btn-info mt-3" type="submit">Internar</button>

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

        $(document).ready(function(){
            $('#data_nasc').mask('00/00/0000');
        });
        
    </script>

    <script src="{{asset('js/form-validation.js')}}"></script>

@endsection