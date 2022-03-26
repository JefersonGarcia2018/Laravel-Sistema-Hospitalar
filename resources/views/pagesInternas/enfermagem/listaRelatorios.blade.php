@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Listagem de Relatórios')


@section('content')

  <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">

            <!-- Main content -->
            <div class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-12 p-2">
                <h1 class="text-center">
                     Relatórios de Enfermagem
                  </h1>
                </div>
              </div><!-- /.row Date -->
              <!-- info Paciente row -->
              <div class="row invoice-info border border-dark">
                <div class="col-sm-4 invoice-col">
                  <b Class="text-danger">Paciente</b>
                  <address class="border-top pt-2">
                    <b>Nome:</b> {{$paciente->name}}<br>
                    <b>Prontuário:</b> {{$paciente->id}}<br>
                    <b>Data Nascimento:</b> {{date('d/m/Y', strtotime($paciente->data_nasc))}}<br>
                    <b>Sexo:</b> {{$paciente->sexo}}<br>
                    <b>Internação especialidade médica:</b> {{$paciente->especialidade}}<br>
                  </address>
                </div> 
                <!-- /.col --> 
              </div>
              <!-- /.row -->

              <!-- row ListaRelatorios -->
              <div>
                @if(count($arrayObjRelatorios) > 0)
                  @foreach($arrayObjRelatorios as $relatorio)
                  <div class="row mt-3 bg-dark text-white">
                    <div class="col-6">
                      {{date('d/m/Y à\s H:i:s', strtotime($relatorio->updated_at))}}
                    </div>
                    <div class="col-6">
                      {{$relatorio->funcionario}}
                    </div>
                  </div>

                  <div class="row border">
                    <div class="col">
                    @if(!empty($relatorio->pa))
                      <span class="text-info fw-bold">PA: </span>{{$relatorio->pa}}
                    @endif
                    @if(!empty($relatorio->fc))
                      <span class="text-info fw-bold">FC: </span>{{$relatorio->fc}}
                    @endif
                    @if(!empty($relatorio->temperatura))
                      <span class="text-info fw-bold">T: </span>{{$relatorio->temperatura}}
                    @endif
                    @if(!empty($relatorio->sat))
                      <span class="text-info fw-bold">SpO2: </span>{{$relatorio->sat}}
                    @endif
                    @if(!empty($relatorio->resp))
                      <span class="text-info fw-bold">R: </span>{{$relatorio->resp}}
                    @endif
                    </div>
                  </div>
                  

                  <div class="row border">
                    <div class="col">
                      {{$relatorio->relatorio}}
                    </div>
                  </div>
                  @endforeach

                  <div class="row d-print-none mt-3">
                     <div class="col text-center">
                       <button onclick="window.print()" class="btn btn-warning" type="button" title="Imprimir prescrição">Imprimir</button>
                     </div>
                  </div>

                @else
                  <div class="row mt-3">
                    <div class="col h4 text-center">
                      Este paciente ainda não possui relatótio.
                    </div>
                  </div>
                @endif
              </div>
              <!-- /row ListaRelatorios -->
            
             
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection