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
          <th class="h4 text-center" colspan="11">Informações dos Pacientes</th>
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
            <a class="btn btn-outline-info" title="Prescrever" href="{{route('prescricao-medica', [$paciente->id])}}" role="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-pulse" viewBox="0 0 16 16">
                <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
                <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
                <path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128L9.979 5.356Z"/>
              </svg>
          </a>
          </td>
          <td>
            <a class="btn btn-outline-warning" title="Lista de Prescrições" href="{{route('lista-prescricoes', [$paciente->id])}}" role="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
              </svg>
            </a>
          </td>
        </tr>

        @endforeach
        
      </tbody>
    </table>
  </div>

@endif

@endsection