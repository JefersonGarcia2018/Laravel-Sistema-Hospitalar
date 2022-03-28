<?php

namespace App\Http\Controllers\PagesInternas\Recepcao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Paciente;

class RecepcaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:recepcao');
    }

    public function indexInternarPaciente()
    {
        return view('pagesInternas/recepcao/internarPaciente');
    }

    public function actionInternarPaciente(Request $request)
    {
        #region Pegando dados provenientes do formulário da view [cadastrar-Paciente]
        $data = $request->only(['name', 'cpf', 'data_nasc', 'email', 'celular', 'radioOpcaoSexo', 'especialidadeMedica']);
        #endregion

        #region Modificando o padrão da Data de Nascimento Brasileiro para o padrão Americano.
        $data['data_nasc'] = $this->inverterPadraoDatNasc($data['data_nasc'], 'pt-br', 'en');
        #endregion

        #region Inicializando o $validator e validando os dados enviados
        $validator = $this->validatorInternarPaciente($data);
        #endregion


        #region Verificando se a Data de Nascimento é posterior a Data de Internação.
        if(strtotime($data['data_nasc']) > strtotime(date("Y-m-d"))) {

            $validator->errors()->add('data_nasc', 'A Data de Nascimento informada não pode ser posterior a Data de Internação');
        }
        #endregion


        #region Verificando se o Validator contém algum errro
        if( count($validator->errors()) > 0 ) {
            //dd($validator);
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            $this->createPaciente($data);
        
            return redirect()->route('internar-paciente')->with(['msgSuccess'=>'Paciente internado com sucesso.']);
        }
        #endregion

        
    }


    protected function validatorInternarPaciente(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'data_nasc' => ['required', 'string', 'date_format:Y-m-d'],
            'cpf' => ['required', 'cpf', 'string', 'max:14', 'unique:pacientes'],
            'celular' => ['required', 'celular_com_ddd', 'string', 'max:14'],
            'radioOpcaoSexo' => ['required','string', 'max:1'],
            'especialidadeMedica' => ['required','string', 'max:50']
        ],

        [
            'name.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatório',
            'email.email' => 'O campo Email não contém um email válido',
            'data_nasc.date_format' => 'Data de Nascimento inválida. Exemplo válido: 10/06/1985',
            'cpf.required' => 'CPF é obrigatório',
            'cpf.cpf' => 'O campo CPF não contém um CPF válido',
            'cpf.unique' => 'Já existe paciente cadastrado com o CPF informado.',
            'celular.required' => 'Celular é obrigatório',
            'celular.celular_com_ddd' => 'O campo Celular não contém um número de celular válido',
            'radioOpcaoSexo.required' => 'Selecione o sexo do paciente',
            'especialidadeMedica.required' => 'Selecione uma especialide médica'
        ]);
    }

    protected function createPaciente(array $data)
    {
        $paciente = new Paciente;

        $paciente->name = $data['name'];
        $paciente->cpf = $data['cpf'];
        $paciente->data_nasc = $data['data_nasc'];
        $paciente->email = $data['email'];
        $paciente->celular = $data['celular'];
        $paciente->sexo = $data['radioOpcaoSexo'];
        $paciente->especialidade = $data['especialidadeMedica'];

        $paciente->save();
    }


    public function indexPesquisarPaciente()
    {
        return view('pagesInternas/recepcao/pesquisarPaciente');
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
            return redirect()->route('recepcao-pesquisar-paciente')
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

        
        return view('pagesInternas/recepcao/pesquisarPaciente',[
            'pacientes' => $pacientes
        ]);
    }


    public function indexEditarPaciente($id)
    {

        if(isset($id)) {

            $paciente = Paciente::find($id);

            if($paciente) {

                #region Modificando o padrão da Data de Nascimento Americano para o padrão Brasileiro.
                $paciente->data_nasc = date('d/m/Y', strtotime($paciente->data_nasc));
                #endregion

                return view('pagesInternas/recepcao/editarPaciente', [
                    'paciente' => $paciente,
                    'especialidade' => $paciente->especialidade,
                    'sexo' => $paciente->sexo
                ]);

            } 

        }

        
        return redirect()->back();

        
    }

    public function actionEditarPaciente(Request $request, $id)
    {
        #region Pegando dados provenientes do formulário da view [editarPaciente]
        $data = $request->only(['name', 'cpf', 'data_nasc', 'email', 'celular', 'radioOpcaoSexo', 'especialidadeMedica']);
        #endregion

        #region Modificando o padrão da Data de Nascimento Brasileiro para o padrão Americano.
        $data['data_nasc'] = $this->inverterPadraoDatNasc($data['data_nasc'], 'pt-br', 'en');
        #endregion

        #region Inicializando o $validator e validando os dados enviados
        $validator = $this->validatorEditarPaciente($data);
        #endregion

        #region Verificando se o cpf informado é único no BD
        $user = User::where('id','!=', $id)->Where('cpf', $data['cpf'])->get();
        //dd($user);
        if(count($user) > 0) {

            $validator->errors()->add('cpf_nao_unico', 'O CPF informado já está cadastrado');
        }
        #endregion

        #region Verificando se o Validator contém algum errro
        if( count($validator->errors()) > 0 ) {
            //dd($validator);
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            $this->updatePaciente($data, $id);
            //dd($data);
            return redirect()->back()
            ->with([ 'msgSuccess' => 'Dados do paciente editados com sucesso']);
        }
        #endregion


    }


    protected function validatorEditarPaciente(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'data_nasc' => ['required', 'string', 'date', 'date_format:Y-m-d'],
            'cpf' => ['required', 'cpf', 'string', 'min:14', 'max:14', 'unique:users'],
            'celular' => ['required', 'celular_com_ddd', 'string', 'min:14', 'max:14'],
            'radioOpcaoSexo' => ['required','string', 'max:1'],
            'especialidadeMedica' => ['required','string', 'max:50']
        ],

        [
            'name.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatório',
            'data_nasc.date' => 'Data de Nascimento inválida',
            'data_nasc.date_format' => 'Data de Nascimento inválida. Exemplo válido: 10/06/1985',
            'cpf.required' => 'CPF é obrigatório',
            'celular.required' => 'Celular é obrigatório',
            'radioOpcaoSexo' => 'Selecione o sexo do paciente',
            'especialidadeMedica.required' => 'Selecione uma especialide médica'
        ]);
    }

    protected function updatePaciente(array $data, $id)
    {
        $paciente = paciente::find($id);

        $paciente->name = $data['name'];
        $paciente->cpf = $data['cpf'];
        $paciente->data_nasc = $data['data_nasc'];
        $paciente->email = $data['email'];
        $paciente->celular = $data['celular'];
        $paciente->sexo = $data['radioOpcaoSexo'];
        $paciente->especialidade = $data['especialidadeMedica'];

        $paciente->save();

    }


    public function inverterPadraoDatNasc($data_nasc, $lang1, $lang2)
    {
        switch ($lang1.'->'.$lang2) {
            
            case 'pt-br->en':
                    $data_nasc = explode('/', $data_nasc);
                    $data_nasc = array_reverse($data_nasc);
                    $data_nasc = implode('-', $data_nasc);
                    return $data_nasc;
            break;
            

            case 'en->pt-br':
                    $data_nasc = explode('-', $data_nasc);
                    $data_nasc = array_reverse($data_nasc);
                    $data_nasc = implode('/', $data_nasc);
                    return $data_nasc;
            break;

            default:
                echo "Houve algum erro com a Data de Nascimento";
                break;
        }
    }



}
