<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesExternas\PagesExternasController;
use App\Http\Controllers\PagesExternas\LoginController;
use App\Http\Controllers\PagesInternas\HomeController;
use App\Http\Controllers\PagesInternas\Configuracoes\ConfiguracoesController;
use App\Http\Controllers\PagesInternas\Rh\RhController;
use App\Http\Controllers\PagesInternas\Recepcao\RecepcaoController;
use App\Http\Controllers\PagesInternas\Medicina\MedicinaController;
use App\Http\Controllers\PagesInternas\Enfermagem\EnfermagemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('/')->group( function(){

    Route::get('/', [HomeController::class, 'home'])->name('/');

    Route::get('/login', [LoginController::class, 'loginIndex'])->name('login');
    Route::post('/login', [LoginController::class, 'loginAction']);

    Route::get('/sobre', [PagesExternasController::class, 'sobre'])->name('sobre');
    Route::get('/servicos', [PagesExternasController::class, 'servicos'])->name('servicos');
    Route::get('/contatos', [PagesExternasController::class, 'contatos'])->name('contatos');

    Route::get('/logout', [ LoginController::class, 'logout' ])->name('logout')->middleware('auth');

    Route::prefix('/configuracoes')->group( function(){

            Route::get('/', [ConfiguracoesController::class, 'indexConfiguracoes'])->name('configuracoes');
            Route::post('redefinir-senha', [ConfiguracoesController::class, 'redefinirSenha'])->name('redefinir-senha');      

        });

    Route::prefix('/rh')->group( function(){

            Route::get('/cadastrar-funcionario', [RhController::class, 'indexCadastarFuncionario'])->name('cadastrar-funcionario');
            Route::post('/cadastrar-funcionario', [RhController::class, 'actionCadastarFuncionario']);

            Route::get('/pesquisar-funcionario', [RhController::class, 'indexPesquisarFuncionario'])->name('pesquisar-funcionario');
            Route::post('/pesquisar-funcionario', [RhController::class, 'actionPesquisarFuncionario']);

            Route::get('/editar-funcionario', [RhController::class, 'indexEditarFuncionario'])->name('index-editar-funcionario');
            Route::post('/editar-funcionario', [RhController::class, 'actionEditarFuncionario']);

            

        });

    Route::prefix('/recepcao')->group( function(){

            Route::get('/internar-paciente', [RecepcaoController::class, 'indexInternarPaciente'])->name('internar-paciente');
            Route::post('/internar-paciente', [RecepcaoController::class, 'actionInternarPaciente']);

            Route::get('/pesquisar-paciente', [RecepcaoController::class, 'indexPesquisarPaciente'])->name('recepcao-pesquisar-paciente');
            Route::post('/pesquisar-paciente', [RecepcaoController::class, 'actionPesquisarPaciente']);

            Route::get('/editar-paciente/{id}', [RecepcaoController::class, 'indexEditarPaciente'])->name('index-editar-paciente');
            Route::post('/editar-paciente/{id}', [RecepcaoController::class, 'actionEditarPaciente']);

            

        });


    Route::prefix('/medicina')->group( function(){

            Route::get('/lista-pacientes', [MedicinaController::class, 'indexListaPacientes'])->name('lista-pacientes');

            Route::get('/pesquisar-paciente', [MedicinaController::class, 'indexPesquisarPaciente'])->name('medicina-pesquisar-paciente');
            Route::post('/pesquisar-paciente', [MedicinaController::class, 'actionPesquisarPaciente']);

            Route::get('/prescricao-medica/{id_paciente}', [MedicinaController::class, 'indexPrescricaoMedica'])->name('prescricao-medica');
            Route::post('/prescricao-medica', [MedicinaController::class, 'actionPrescricaoMedica']);

            Route::get('/visualizar-prescricao/{id_prescricao}', [MedicinaController::class, 'indexVisualizarPrescricao'])->name('visualizar-prescricao');

            Route::get('/lista-prescricoes/{id_paciente}', [MedicinaController::class, 'indexListaPrescricoes'])->name('lista-prescricoes');
        });


    Route::prefix('/enfermagem')->group( function(){

            Route::get('/lista-pacientes', [EnfermagemController::class, 'indexListaPacientes'])->name('lista-pacientes-enfermagem');

            Route::get('/pesquisar-paciente', [EnfermagemController::class, 'indexPesquisarPaciente'])->name('enfermagem-pesquisar-paciente');
            Route::post('/pesquisar-paciente', [EnfermagemController::class, 'actionPesquisarPaciente']);
            

            Route::get('/relatorio-enfermagem/{id_paciente}', [EnfermagemController::class, 'indexRelatorioEnfermagem'])->name('relatorio-enfermagem');
            Route::post('/relatorio-enfermagem/{id_paciente}', [EnfermagemController::class, 'salvarRelatorioEnfermagem']);
            
            Route::get('/lista-relatorios/{id_paciente}', [EnfermagemController::class, 'indexListaRelatorios'])->name('lista-relatorios');
        });


});


