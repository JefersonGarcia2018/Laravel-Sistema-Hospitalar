@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Visualizar Prescrição')


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
                     Prescrição Médica
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

              <!-- row Table -->
              <div class="row my-4">
                <div class="col table-responsive">

                  <table id="minhaTabela" class="table table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Itens Prescritos</th>
                        <th scope="col">Horário</th> 
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($dieta))
                      <tr>
                        <td>{{++$indice}} - Dieta {{$dieta}}</td>
                        <td></td>
                      </tr>
                      @endif
                      @if(!empty($arrayMedicacoes))
                      @foreach($arrayMedicacoes as $medicacao)
                      <tr>
                        <td>{{++$indice}} - {{$medicacao['medicacao']}}</td>
                        <td>{{$medicacao['horario']}}</td>
                      </tr>
                      @endforeach
                      @endif
                      @if(!empty($arrayOutros))
                      @foreach($arrayOutros as $item)
                      <tr>
                        <td>{{++$indice}} - {{$item}}</td>
                        <td></td>
                      </tr>
                      @endforeach
                      @endif
                      
                    </tbody>

                  </table>
                </div>
              </div>
              <!-- /row Table -->
             
             <div class="row justify-content-center mt-5">
               <div class="col-md-4 text-center">
                 ____________________________________________
               </div>
             </div>
             <div class="row justify-content-center">
               <div class="col-md-3 text-center">
                 Assinatura e carimbo<br>
                 <b>Médico:</b> {{$medico->name}}
               </div>
             </div>

             <div class="row d-print-none mt-3">
               <div class="col text-center">
                 <button onclick="window.print()" class="btn btn-warning" type="button" title="Imprimir prescrição">Imprimir</button>
               </div>
             </div>
            
             
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
