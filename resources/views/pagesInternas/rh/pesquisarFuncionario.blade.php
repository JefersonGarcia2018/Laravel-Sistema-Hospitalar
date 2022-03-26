@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Pesquisar Funcionário')

@section('header')
  <div class="row">
    <div class="col bg-light text-dark text-center p-2 mb-3 mx-3 border">
      <b>Pesquisar Funcionário</b>
    </div>
  </div>

  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      
      <form method="POST">
        @csrf

        <div class="d-flex mb-2">
          <input 
          class="form-control me-2" 
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
      

      <div class="d-flex">
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
          type="radio" name="radioOpcao" 
          id="radioCpf" 
          value="cpf" 
          @if(session('radioOpcao') == 'cpf') checked @endif
          >
          <label class="form-check-label" for="radioCpf">CPF <span class="text-muted">(com pontuação)</span></label>
        </div>
      </div>

      </form>

    </div>
  </nav>
@endsection

@section('content')

  @if(session('radioOpcao'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          Funcionario com [ {{session('radioOpcao')}}: {{session('item_pesquisa')}} ] não encontrado.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(isset($arrayObjFuncionarios))

  <div class="table-responsive">
  <table class="table">
      <thead>
        <tr>
          <th class="h4 text-center" colspan="6">Informações de Funcionarios</th>
        </tr>
        <tr class="bg-dark text-white">
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
          <th scope="col">Celular</th>
          <th scope="col">Email</th>
          <th scope="col">Cargo</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach($arrayObjFuncionarios as $key => $funcionario)
        <tr>
          <td>{{$funcionario->name}}</td>
          <td>{{$funcionario->cpf}}</td>
          <td>{{$funcionario->celular}}</td>
          <td>{{$funcionario->email}}</td>
          <td>{{$funcionario->cargo}}</td>
          <td>
            <form action="{{route('index-editar-funcionario')}}">
            @csrf
            <input type="hidden" name="id_funcionario" value="{{$funcionario->id}}">
            <button type="submit" class="btn btn-warning">Editar</button>
            </form>
          </td>
        </tr>

        @endforeach
        
      </tbody>
    </table>
  </div>

@endif

@endsection