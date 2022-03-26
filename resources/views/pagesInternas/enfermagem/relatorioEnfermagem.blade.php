@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Relatório de Enfermagem')

@section('header')
  <div class="row">
    <div class="col bg-info bg-gradient text-dark text-center p-2 mb-3 mx-3 border">
      <b>Relatório de Enfermagem</b>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <b>Paciente:</b> {{$paciente->name}}
    </div>
    <div class="col-md-4">
      <b>Prontuário:</b> {{$paciente->id}}
    </div>
    <div class="col-md-4">
      <b>Especialidade:</b> {{$paciente->especialidade}}
    </div>
  </div>
@endsection

@section('content')

  @if(isset($msgSuccess))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{$msgSuccess}}

      <a class="btn btn-info" title="Ver relatório" href="{{route('lista-relatorios', [$paciente->id])}}" role="button">Ver relatório</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(isset($msgErro))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
      {{$msgErro}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

<form method="POST">
  @csrf

<div class="row row-cols-1 mt-5 text-center">

      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3 bg-warning bg-gradient text-white">
            <h4 class="my-0 fw-normal"><b>SSVV:</b> </h4>
          </div>
          <div class="card-body">
      
          <div class="row">
            <label class="col-2 col-sm-2 col-md-2 col-lg-1 col-form-label text-info" for="pa"><b>PA:</b></label>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
              <input type="text" name="pa" class="form-control" id="pa" maxlength="7">
            </div> mmHg
          </div>

          <div class="row mt-2">
            <label class="col-2 col-sm-2 col-md-2 col-lg-1 col-form-label text-info" for="fc"><b>FC:</b></label>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
              <input type="text" name="fc" class="form-control" id="fc" maxlength="3">
            </div> bpm
          </div>

          <div class="row mt-2">
            <label class="col-2 col-sm-2 col-md-2 col-lg-1 col-form-label text-info" for="temperatura"><b>T:</b></label>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
              <input type="text" name="temperatura" class="form-control" id="temperatura" maxlength="4">
            </div> °C
          </div>

          <div class="row mt-2">
            <label class="col-2 col-sm-2 col-md-2 col-lg-1 col-form-label text-info" for="sat"><b>SpO2:</b></label>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
              <input type="text" name="sat" class="form-control" id="sat" maxlength="3">
            </div> %
          </div>

          <div class="row mt-2">
            <label class="col-2 col-sm-2 col-md-2 col-lg-1 col-form-label text-info" for="resp"><b>R:</b></label>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
              <input type="text" name="resp" class="form-control" id="resp" maxlength="2">
            </div> mpm
          </div>

          </div>
        </div>
      </div>

    </div>


    <div class="row row-cols-1 mt-5 text-center">

      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3 bg-warning bg-gradient text-white">
            <h4 class="my-0 fw-normal"><b>Relatório:</b> </h4>
          </div>
          <div class="card-body">
      
          <div class="mb-3">
            <textarea class="form-control" name="relatorio" rows="3" placeholder="Escreva aqui..."></textarea>
          </div>

          </div>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col">
        <input class="btn btn-info" type="submit" value="Salvar Relatório">
      </div>
    </div>

</form>

@endsection

