@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Prescrição Médica')

@section('header')
  <div class="row">
    <div class="col bg-info bg-gradient text-dark text-center p-2 mb-3 mx-3 border">
      <b>Prescrição Médica</b>
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

<div class="row mt-5">
  <div class="col">

  <div id="dieta" class="row border">
    <div class="col p-2">
      <div class="row">
        <label class="col-md-1 col-form-label text-info" for="inputDieta"><b>Dieta:</b></label>
        <div class="col-md-4">
          <input type="text" name="dieta" class="form-control" id="inputDieta">
        </div>
      </div>
      <div class="col-auto mt-3">
        <button type="button" id="btn_add_dieta" class="btn btn-info">Adicionar</button>
      </div>
    </div>
  </div>

  <div id="medicacao" class="row border mt-2">
    <div class="col p-2">

  <div class="row mb-3">
    <label class="col-md-2 col-form-label text-info" for="inputMedicacao"><b>Medicação:</b></label>
    <div class="col-md-4">
      <input type="text" class="form-control" id="inputMedicacao">
    </div>
  </div>

  <fieldset class="row mb-3">
    <legend class="col-form-label col-md-2 pt-0 text-info"><b>Via de administração:</b></legend>
    <div class="col-md-10">

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosVia" id="radioEV" value="(EV)">
        <label class="form-check-label" for="radioEV">
          EV
        </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosVia" id="radioVO" value="(VO)">
        <label class="form-check-label" for="radioVO">
          VO
        </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosVia" id="radioIM" value="(IM)">
        <label class="form-check-label" for="radioIM">
          IM
        </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosVia" id="radioSC" value="(SC)">
        <label class="form-check-label" for="radioSC">
          SC
        </label>
      </div>

    </div>
  </fieldset>

  <fieldset class="row mb-3">
    <legend class="col-form-label col-md-2 pt-0 text-info"><b>Horário:</b></legend>
    <div class="col-md-10">

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosHorario" id="radio_1xdia" value=" - 10">
        <label class="form-check-label" for="radio_1xdia">
          1 ao dia
        </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosHorario" id="radio_2_2h" value="de 2/2h - 06 08 10 12 14 16 18 20 22 24 02 04">
        <label class="form-check-label" for="radio_2_2h">
          2/2h
        </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosHorario" id="radio_4_4h" value="de 4/4h - 06 10 14 18 22 02">
        <label class="form-check-label" for="radio_4_4h">
          4/4h
        </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosHorario" id="radio_6/6h" value="de 6/6h - 06 12 18 24">
        <label class="form-check-label" for="radio_6/6h">
          6/6h
        </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosHorario" id="radio_8/8h" value="de 8/8h - 06 14 22">
        <label class="form-check-label" for="radio_8/8h">
          8/8h
        </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="radiosHorario" id="radio_12/12h" value="de 12/12h - 10 22">
        <label class="form-check-label" for="radio_12/12h">
          12/12h
        </label>
      </div>

    </div>
  </fieldset>

    <div id="avisoMedicacao">
      
    </div>

    <div class="col-md-2">
      <button type="button" id="btn_add_medicacao" class="btn btn-info">Adicionar</button>
    </div>

    </div>
  </div>


  <div id="outro" class="row border mt-2">
    <div class="col p-2">
      <div class="row">
        <label class="col-md-1 col-form-label text-info" for="inputOutro"><b>Outro:</b></label>
        <div class="col-md-4">
          <input type="text" name="outros" class="form-control" id="inputOutros">
        </div>
      </div>
      <div class="col-auto mt-3">
        <button type="button" id="btn_add_outros" class="btn btn-info">Adicionar</button>
      </div>
    </div>
  </div>
  
      
  </div>
</div>

<div class="row my-4">
  <div class="col table-responsive">

    <table id="minhaTabela" class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          
          <th scope="col">Itens Prescritos</th>
          <th scope="col">Horário</th>
          <th scope="col" class="text-center">Excluir item</th>
          
        </tr>
      </thead>

      <tbody id="tbody">
        
      </tbody>

    </table>

  </div>
</div>

  <div class="row justify-content-center" id="alertCadastro"></div>

  <div class="row">
    <div class="col text-center">
      <button id="btn_registrar" class="btn btn-success" type="button">Registrar</button>
    </div>
  </div>

@endsection

@section('js')

    <script type="text/javascript">
      let func = "{{Auth::user()->id}}";
      let pac = "{{$paciente->id}}";
    </script>

    <script src="{{asset('js/js-setor-medicina/imprimir-itens-prescricao.js')}}"></script>

    <script src="{{asset('js/js-setor-medicina/ajax-prescricao.js')}}"></script>

@endsection