<?php

namespace App\Http\Controllers\PagesInternas\Enfermagem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Paciente;
use App\Models\Relatorio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EnfermagemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        return view('pagesInternas/enfermagem/listaPacientes', [
            'arrayObjPacientes' => $pacientes
        ]);
    }

    public function indexRelatorioEnfermagem($id_paciente)
    {
        $paciente = Paciente::find($id_paciente);

        return view('pagesInternas/enfermagem/relatorioEnfermagem', [
            'paciente' => $paciente
        ]);
    }

    public function salvarRelatorioEnfermagem($id_paciente, Request $request)
    {
        $dados = $request->only(['pa','fc','temperatura','sat','resp','relatorio']);

        $paciente = Paciente::find($id_paciente);

        if(empty($dados['pa']) && empty($dados['fc']) && empty($dados['temperatura']) && empty($dados['sat']) && empty($dados['resp']) && empty($dados['relatorio'])) {
            
            return view('pagesInternas/enfermagem/relatorioEnfermagem', [
                'paciente' => $paciente,
                'msgErro'=>'Todos os campos estão em branco. Não há dados para salvar.'
                 ]);
            
        }

        $this->createRelatorio($id_paciente, $dados);

        return view('pagesInternas/enfermagem/relatorioEnfermagem', [
                'paciente' => $paciente,
                'msgSuccess'=>'Relatório salvo com sucesso.'
                 ]);
    }

    protected function createRelatorio($id_paciente, array $dados)
    {
        $relatorio = new Relatorio;

        $relatorio->id_funcionario = Auth::id();
        $relatorio->id_paciente = $id_paciente;
        $relatorio->pa = $dados['pa'];
        $relatorio->fc = $dados['fc'];
        $relatorio->temperatura = $dados['temperatura'];
        $relatorio->sat = $dados['sat'];
        $relatorio->resp = $dados['resp'];
        $relatorio->relatorio = $dados['relatorio'];
        
        $relatorio->save();
    }

    public function indexListaRelatorios($id_paciente) {

        $relatorios = Relatorio::where('id_paciente', $id_paciente)->paginate(50);

        if(count($relatorios) > 0) {
            
            foreach($relatorios as $relatorio) {

                $funcionario = User::where('id', $relatorio->id_funcionario)->first();

                $relatorio->funcionario = $funcionario->cargo.': '.$funcionario->name;

            }
        }

        $paciente = Paciente::find($id_paciente);

        return view('pagesInternas/enfermagem/listaRelatorios', [
            'arrayObjRelatorios' => $relatorios,
            'paciente' => $paciente
        ]);

    }

    public function indexPesquisarPaciente() {

        return view('pagesInternas/enfermagem/pesquisarPaciente');
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
            return redirect()->route('pesquisar-paciente')
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

        
        return view('pagesInternas/enfermagem/pesquisarPaciente',[
            'pacientes' => $pacientes
        ]);
    }


}
