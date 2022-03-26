@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Configurações')


@section('content')

	<div class="accordion" id="accordionConfiguracoes">
		  <div class="accordion-item">
		    <h2 class="accordion-header" id="headingRedefSenha">
		      <button class="accordion-button @if(session('showRedefinirSenha')) @else collapsed @endif bg-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRedefSenha" aria-expanded="false" aria-controls="collapseRedefSenha">
		        <b>Redefinir Senha</b>
		      </button>
		    </h2>
		    <div id="collapseRedefSenha" class="accordion-collapse collapse @if(session('showRedefinirSenha')) show @else @endif }}" aria-labelledby="headingRedefSenha" data-bs-parent="#accordionConfiguracoes">
		      <div class="accordion-body">

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
		        
		        <div class="row">
		        	<div class="col-md-4">
		        		<form id="form-Validation" novalidate method="POST" action="{{route('redefinir-senha')}}">
        				@csrf

        				<div class="row mt-3">
				            <div class="col">
				              <label for="password_atual" class="form-label">Senha Atual</label>
				              <input 
				              type="password"
				              name="password_atual"
				              value="{{old('password_atual')}}" 
				              class="form-control @error('password_atual') is-invalid @enderror" 
				              id="password_atual" 
				              placeholder="" 
				              class="@error('password_atual') is-invalid @enderror"
				              required 
				              >
				              <div class="invalid-feedback">
				                Preenchimento obrigatório
				              </div>
				            </div>
				          </div>

				          <div class="row mt-3">
				            <div class="col">
				              <label for="new_password" class="form-label">Nova Senha <span class="text-muted">(no mínimo, 8 caracteres)</span></label>
				              <input 
				              type="password"
				              name="new_password"
				              value="{{old('new_password')}}" 
				              class="form-control @error('new_password') is-invalid @enderror" 
				              id="new_password" 
				              placeholder="" 
				              class="@error('new_password') is-invalid @enderror"
				              required 
				              >
				              <div class="invalid-feedback">
				                Preenchimento obrigatório
				              </div>
				            </div>
				          </div>

				          <div class="row mt-3">
				            <div class="col">
				              <label for="password_confirmation" class="form-label">Confirmação da Nova Senha</label>
				              <input 
				              type="password"
				              name="password_confirmation"
				              value="{{old('password_confirmation')}}" 
				              class="form-control @error('password_confirmation') is-invalid @enderror" 
				              id="password_confirmation" 
				              placeholder="" 
				              class="@error('password_confirmation') is-invalid @enderror"
				              required 
				              >
				              <div class="invalid-feedback">
				                Preenchimento obrigatório
				              </div>
				            </div>
				          </div>
		        			
		        			<button class="btn btn-info mt-3" type="submit">Redefinir</button>
		        		</form>
		        	</div>
		        </div>

		      </div>
		    </div>
		  </div>
		  <div class="accordion-item">
		    <h2 class="accordion-header" id="headingThree">
		      <button class="accordion-button collapsed bg-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		        <b>Outra configuração</b>
		      </button>
		    </h2>
		    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionConfiguracoes">
		      <div class="accordion-body">
		        Área para implementar qualquer outra configuração.
		      </div>
		    </div>
		  </div>
		</div>  

@endsection