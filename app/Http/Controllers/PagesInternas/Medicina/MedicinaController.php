<?php

namespace App\Http\Controllers\PagesInternas\Medicina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Prescricao;

class MedicinaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:medicina', [
            'except' => ['indexListaPrescricoes', 'indexVisualizarPrescricao']
        ]);
    }

    public function indexListaPacientes()
    {
        $pacientes = Paciente::paginate(50);

        #region Obtendo a idade dos pacientes
        foreach($pacientes as $paciente) {
            $data_nasc = new \DateTime($paciente->data_nasc);
            $today = new \DateTime('today');
            $paciente->idade = $data_nasc->diff($today)->y;
        }
        #endregion

        return view('pagesInternas/medicina/listaPacientes', [
            'arrayObjPacientes' => $pacientes
        ]);
    }


    public function indexPesquisarPaciente()
    {
        return view('pagesInternas/medicina/pesquisarPaciente');
    }

    public function actionPesquisarPaciente(Request $request)
    {
        $dados = $request->only(['radioOpcao','item_pesquisa']);

        if ($dados['radioOpcao'] == 'name') 
        {
            $pacientes = Paciente::where('name', 'LIKE', "%{$dados['item_pesquisa']}%")->paginate(50);
        }

        if ($dados['radioOpcao'] == 'cpf') 
        {
            $pacientes = Paciente::where('cpf', $dados['item_pesquisa'])->get();
        }

        if ($dados['radioOpcao'] == 'prontuario') 
        { //O id do paciente representa o número do Prontuário.
            $pacientes = Paciente::where('id', $dados['item_pesquisa'])->get();
        }

        
        if (count($pacientes) == 0) 
        {
            return redirect()->route('medicina-pesquisar-paciente')
                    ->with([
                            'radioOpcao' => $dados['radioOpcao'],
                            'item_pesquisa' => $dados['item_pesquisa'],
                            ])
                    ->withInput();//redireciona preenchendo os inputs
        }

        #region Obtendo a idade dos pacientes
        foreach($pacientes as $paciente) {
            $data_nasc = new \DateTime($paciente->data_nasc);
            $today = new \DateTime('today');
            $paciente->idade = $data_nasc->diff($today)->y;
        }
        #endregion

        
        return view('pagesInternas/medicina/pesquisarPaciente',[
            'pacientes' => $pacientes
        ]);
    }


    public function indexPrescricaoMedica($id_paciente)
    {
        $paciente = Paciente::find($id_paciente);

        return view('pagesInternas/medicina/prescricaoMedica', [
            'paciente' => $paciente
        ]);
    }

    public function indexVisualizarPrescricao($id_prescricao) {

        $prescricao = Prescricao::find($id_prescricao);

        $itensPrescritos = json_decode($prescricao->prescricao, true);

        $dieta = array_slice($itensPrescritos, 0, 1);
        $dieta = $dieta['dieta'];
        $medicacoes = array_slice($itensPrescritos, 1, 1);
        $medicacoes = $medicacoes['medicacoes'];
        $outros = array_slice($itensPrescritos, 2, 1);
        $outros = $outros['outros'];

        $arrayMedicacoes = [];

        if($medicacoes) {
            foreach($medicacoes as $item) {
                $medicacao = ['medicacao' => '', 'horario' => ''];
                $arrayHorario = explode('-', $item['horario']);

                $medicacao['medicacao'] = $item['nomeMedicacao'].' '.$item['via'].' '.$arrayHorario[0];
                $medicacao['horario'] = $arrayHorario[1];

                $arrayMedicacoes[] = $medicacao;
            }
        }

        $medico = User::find($prescricao->id_medico);
        $paciente = Paciente::find($prescricao->id_paciente);

        return view('pagesInternas/medicina/visualizarPrescricao', [
            'dieta' => $dieta,
            'arrayMedicacoes' => $arrayMedicacoes,
            'arrayOutros' => $outros,
            'medico' => $medico,
            'paciente' => $paciente,
            'indice' => 0
        ]);
    }

    public function indexListaPrescricoes($id_paciente)
    {
        $prescricoes = Prescricao::where('id_paciente', $id_paciente)->paginate(50);

        foreach($prescricoes as $prescricao) {

            //$medico = User::find($prescricao->id_medico);

            $nomeMedico = User::where('id', $prescricao->id_medico)->first(['name'])->name;

            $prescricao->nomeMedico = $nomeMedico;

        }

        $paciente = Paciente::find($id_paciente);

        return view('pagesInternas/medicina/listaPrescricoes', [
            'arrayObjPrescricoes' => $prescricoes,
            'paciente' => $paciente
        ]);
    }
}
