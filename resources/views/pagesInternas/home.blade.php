@extends('pagesInternas.layout.layoutInterno')

@section('title', 'Home')


@section('content')

  <div class="row row-cols-1 row-cols-md-2 mb-3 text-center justify-content-center">

      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3 bg-success bg-gradient text-white">
            <h4 class="my-0 fw-normal"><b>Setor:</b> {{$user->setor}}</h4>
          </div>
          <div class="card-body">
      
      		<div class="text-start"><b>Funcionário:</b> {{$user->name}}</div>
      		<div class="text-start"><b>Cargo:</b> {{$user->cargo}}</div>

          </div>
        </div>
      </div>

    </div>

@endsection

