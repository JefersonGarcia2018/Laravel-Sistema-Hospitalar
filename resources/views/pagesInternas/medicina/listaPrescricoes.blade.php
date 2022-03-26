@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Listagem de Prescrições')

@section('header')
  <div class="row">
    <div class="col bg-info bg-gradient text-dark text-center p-2 mb-3 mx-3 border">
      <b>Listagem de Prescrições</b>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <b class="text-danger">Paciente:</b> <span class="h5">{{$paciente->name}}</span>
    </div>
    <div class="col-md-3">
      <b class="text-danger">Sexo:</b> <span class="h5">{{$paciente->sexo}}
    </div>
    <div class="col-md-3">
      <b class="text-danger">DN:</b> <span class="h5">{{date('d/m/Y', strtotime($paciente->data_nasc))}}
    </div>
    <div class="col-md-3">
      <b class="text-danger">Prontuário:</b> <span class="h5">{{$paciente->id}}
    </div>
  </div>
@endsection

@section('content')

  @if(isset($arrayObjPrescricoes))

  <div class="table-responsive mt-3">
  <table class="table">
      <thead>
        <tr class="bg-dark text-white">
          <th scope="col">Data / hora</th>
          <th scope="col">Médico</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach($arrayObjPrescricoes as $key => $prescricao)
        <tr>
          <td>{{date('d/m/Y à\s H:i:s', strtotime($prescricao->updated_at))}}</td>
          <td>{{$prescricao->nomeMedico}}</td>
          <td>
          	<a class="btn btn-outline-warning" title="Ver Prescrição" href="{{route('visualizar-prescricao', $prescricao->id)}}" role="button">
          		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
				  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
				  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
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