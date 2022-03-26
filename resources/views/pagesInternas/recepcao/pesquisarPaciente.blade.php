@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Pesquisar Paciente')

@section('header')
  <div class="row">
    <div class="col bg-info bg-gradient text-dark text-center p-2 mb-3 mx-3 border">
      <b>Pesquisar Paciente</b>
    </div>
  </div>

  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      
      <form method="POST">
        @csrf

        <div class="d-md-flex mb-2">
          <input 
          class="form-control me-2 mb-2" 
          type="search" 
          placeholder="Pesquisar..." 
          aria-label="Search" 
          name="item_pesquisa" 
          required 
          value="{{old('item_pesquisa')}}"
          autocomplete="off"
          >
          <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </div>
      

      <div class="d-md-flex">
        <b class="mx-2">Pesquisar por:</b>

        <div class="form-check form-check-inline">
          <input 
          class="form-check-input" 
          type="radio" 
          name="radioOpcao" 
          id="radioName" 
          value="name" 
          required  
          
          @if(session('radioOpcao') == 'name') checked @endif
          >
          <label class="form-check-label" for="radioName">Nome</label>
        </div>
        <div class="form-check form-check-inline">
          <input 
          class="form-check-input" 
          type="radio" 
          name="radioOpcao" 
          id="radioCpf" 
          value="cpf" 
          @if(session('radioOpcao') == 'cpf') checked @endif
          >
          <label class="form-check-label" for="radioCpf">CPF <span class="text-muted">(com pontuação)</span></label>
        </div>
        
        <div class="form-check form-check-inline">
          <input 
          class="form-check-input" 
          type="radio" 
          name="radioOpcao" 
          id="radioProntuario" 
          value="prontuario" 
          @if(session('radioOpcao') == 'prontuario') checked @endif
          >
          <label class="form-check-label" for="radioProntuario">Prontuário</label>
        </div>
      </div>

      </form>

    </div>
  </nav>
@endsection

@section('content')

  @if(session('radioOpcao'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          Paciente com [ {{session('radioOpcao')}}: {{session('item_pesquisa')}} ] não encontrado.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(isset($pacientes))

  <div class="table-responsive mt-3">
  <table class="table">
      <thead>
        <tr>
          <th class="h4 text-center" colspan="9">Informações dos Pacientes</th>
        </tr>
        <tr class="bg-dark text-white">
          <th scope="col">Nº Prontuário</th>
          <th scope="col">Nome</th>
          <th scope="col">Sexo</th>
          <th scope="col">CPF</th>
          <th scope="col">DN</th>
          <th scope="col">Idade</th>
          <th scope="col">Celular</th>
          <th scope="col">Email</th>
          <th scope="col">Especialidade Médica</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pacientes as $key => $paciente)
        <tr>
          <td>{{$paciente->id}}</td>
          <td>{{$paciente->name}}</td>
          <td>{{$paciente->sexo}}</td>
          <td>{{$paciente->cpf}}</td>
          <td>{{date('d/m/Y', strtotime($paciente->data_nasc))}}</td>
          <td>{{$paciente->idade}} anos</td>
          <td>{{$paciente->celular}}</td>
          <td>{{$paciente->email}}</td>
          <td>{{$paciente->especialidade}}</td>
          <td>
            <a class="btn btn-warning" href="{{route('index-editar-paciente', [$paciente->id])}}" role="button">Editar</a>
          </td>
        </tr>

        @endforeach
        
      </tbody>
    </table>
  </div>

@endif

@endsection