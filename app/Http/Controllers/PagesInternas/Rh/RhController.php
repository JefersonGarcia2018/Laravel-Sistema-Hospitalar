<?php

namespace App\Http\Controllers\PagesInternas\Rh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RhController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:rh');
    }

    public function indexCadastarFuncionario()
    {
        return view('pagesInternas/rh/cadastrarFuncionario');
    }

    public function actionCadastarFuncionario(Request $request)
    {
        #region Pegando dados provenientes do formulário da view [cadastrar-funcionario]
        $data = $request->only(['name', 'cpf', 'email', 'celular', 'cargo_setor']);
        #endregion

        //dd($data['cargo_setor']);

        $validator = $this->validatorCadastar($data);

        if($validator->fails())
        {

            return redirect()->route('cadastrar-funcionario')
            ->withErrors($validator)
            ->withInput();//redireciona preenchendo os inputs
        }

        #region Definindo Cargo e Setor conforme o <select>
        switch ($data['cargo_setor']) {
            case '1':
                      $data['cargo'] = 'Recepcionista';
                      $data['setor'] = 'Recepção';
                      $colunaAutorizacao = 'recepcao';
                break;

            case '2':
                      $data['cargo'] = 'Analista de RH';
                      $data['setor'] = 'RH';
                      $colunaAutorizacao = 'rh';
                break;

            case '3':
                      $data['cargo'] = 'Enfermeiro';
                      $data['setor'] = 'Enfermagem';
                      $colunaAutorizacao = 'enfermagem';
                break;

            case '4':
                      $data['cargo'] = 'Técnico em enfermagem';
                      $data['setor'] = 'Enfermagem';
                      $colunaAutorizacao = 'enfermagem';
                break;

            case '5':
                      $data['cargo'] = 'Médico clínico geral';
                      $data['setor'] = 'Medicina';
                      $colunaAutorizacao = 'medicina';
                break;

            case '6':
                      $data['cargo'] = 'Médico cirurgião geral';
                      $data['setor'] = 'Medicina';
                      $colunaAutorizacao = 'medicina';
                break;
                    
            default:
                      return redirect()->route('cadastrar-funcionario')
                        ->with(['errorSelectCargo'=>'Holve algum Erro no select de Cargo do funcionário'])
                        ->withInput();
                break;
        }
        #endregion

        $this->createFuncionario($data, $colunaAutorizacao);
        
        return redirect()->route('cadastrar-funcionario')->with(['msgSuccess'=>'Funcionário cadastrado com sucesso.']);
    }

    protected function validatorCadastar(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cpf' => ['required', 'cpf', 'string', 'max:14', 'unique:users'],
            'celular' => ['required', 'celular_com_ddd', 'string', 'max:14'],
            'cargo_setor' => ['required','string', 'max:50']
        ],[
            'name.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatório',
            'cpf.required' => 'CPF é obrigatório',
            'cpf.cpf' => 'O campo CPF não contém um CPF válido.',
            'celular.required' => 'Celular é obrigatório',
            'celular.celular_com_ddd' => 'O campo Celular não é um celular válido.',
            'cargo_setor.required' => 'Selecione um cargo'
        ]);
    }

    protected function createFuncionario(array $data, $colunaAutorizacao)
    {
        $cpfSemPontuacao = str_replace(['.','-'], '', $data['cpf']);

        $user = new User;

        $user->name = $data['name'];
        $user->cpf = $data['cpf'];
        $user->email = $data['email'];
        $user->celular = $data['celular'];
        $user->cargo = $data['cargo'];
        $user->setor = $data['setor'];
        $user->$colunaAutorizacao = '1';
        $user->password = Hash::make($cpfSemPontuacao);

        $user->save();
    }

    public function indexPesquisarFuncionario()
    {
        return view('pagesInternas/rh/pesquisarFuncionario');
    }

    public function actionPesquisarFuncionario(Request $request)
    {
        $dados = $request->only(['radioOpcao','item_pesquisa']);

        if ($dados['radioOpcao'] == 'name') 
        {
            $name = $dados['item_pesquisa'];

            $funcionarios = User::where('name', 'LIKE', "%{$name}%")->paginate(50);
        }

        if ($dados['radioOpcao'] == 'cpf') 
        {
            $cpf = $dados['item_pesquisa'];

            $funcionarios = User::where('cpf', $cpf)->paginate(50);
        }

        //dd($funcionarios);

        if (count($funcionarios) == 0) 
        {
            return redirect()->route('pesquisar-funcionario')
                    ->with([
                            'radioOpcao' => $dados['radioOpcao'],
                            'item_pesquisa' => $dados['item_pesquisa'],
                            ])
                    ->withInput();//redireciona preenchendo os inputs
        }

        $arrayObjFuncionarios = [];
        
        foreach($funcionarios as $funcionario)
        {
            $obj = new \stdClass();

            $obj->id = $funcionario->id;
            $obj->name = $funcionario->name;
            $obj->celular = $funcionario->celular;
            $obj->cpf = $funcionario->cpf;
            $obj->email = $funcionario->email;
            $obj->cargo = $funcionario->cargo;
            
            $arrayObjFuncionarios[] = $obj;
        }
        
        //dd($arrayObjFuncionarios);
        
        return view('pagesInternas/rh/pesquisarFuncionario',[
            'arrayObjFuncionarios' => $arrayObjFuncionarios
        ]);
    }


    public function indexEditarFuncionario(Request $request)
    {

        if(isset($request->id_funcionario)) {

            $user = User::find($request->id_funcionario);

            if($user) {

                switch ($user->cargo) {
                    
                    case 'Recepcionista': $cargo = '1'; break;

                    case 'Analista de RH': $cargo = '2'; break;

                    case 'Enfermeiro': $cargo = '3'; break;

                    case 'Técnico em enfermagem': $cargo = '4'; break;

                    case 'Médico clínico geral': $cargo = '5'; break;

                    case 'Médico cirurgião geral': $cargo = '6'; break;
                    
                    default: $cargo = '0'; break;
                
                }

                return view('pagesInternas/rh/editarFuncionario', [
                    'user' => $user,
                    'cargo' => $cargo
                ]);

            } 

        }

        
        return redirect()->back();

        
    }

    public function actionEditarFuncionario(Request $request)
    {
        #region Pegando dados provenientes do formulário da view [editarFuncionario]
        $data = $request->only(['name', 'cpf', 'email', 'celular', 'cargo_setor', 'id_funcionario']);
        #endregion

        //dd($data);

        #region Inicializando o $validator e validando os dados enviados
        $validator = $this->validatorEditar($data);
        #endregion

        //dd($validator);

        #region Verificando se o email informado é único no BD
        $user = User::where('id','!=', $data['id_funcionario'])->Where('email', $data['email'])->get();
        
        if(count($user) > 0) {

            $validator->errors()->add('email_nao_unico', 'O Email informado já está cadastrado');
        }
        #endregion

        #region Verificando se o cpf informado é único no BD
        $user = User::where('id','!=', $data['id_funcionario'])->Where('cpf', $data['cpf'])->get();
        //dd($user);
        if(count($user) > 0) {

            $validator->errors()->add('cpf_nao_unico', 'O CPF informado já está cadastrado');
        }
        #endregion

        #region Definindo Cargo e Setor conforme o <select>
        switch ($data['cargo_setor']) {
            case '1':
                      $data['cargo'] = 'Recepcionista';
                      $data['setor'] = 'Recepção';
                      $colunaAutorizacao = 'recepcao';
                break;

            case '2':
                      $data['cargo'] = 'Analista de RH';
                      $data['setor'] = 'RH';
                      $colunaAutorizacao = 'rh';
                break;

            case '3':
                      $data['cargo'] = 'Enfermeiro';
                      $data['setor'] = 'Enfermagem';
                      $colunaAutorizacao = 'enfermagem';
                break;

            case '4':
                      $data['cargo'] = 'Técnico em enfermagem';
                      $data['setor'] = 'Enfermagem';
                      $colunaAutorizacao = 'enfermagem';
                break;

            case '5':
                      $data['cargo'] = 'Médico clínico geral';
                      $data['setor'] = 'Medicina';
                      $colunaAutorizacao = 'medicina';
                break;

            case '6':
                      $data['cargo'] = 'Médico cirurgião geral';
                      $data['setor'] = 'Medicina';
                      $colunaAutorizacao = 'medicina';
                break;
                    
            default:
                      $validator->errors()->add('errorSelectCargo', 'Holve algum Erro no select de Cargo do funcionário');
                break;
        }
        #endregion

        #region Verificando se o Validator contém algum errro
        if( count($validator->errors()) > 0 ) {
            //dd($validator);
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            $this->updateFuncionario($data, $colunaAutorizacao);

            return redirect()->back()
            ->with([ 'msgSuccess' => 'Dados do funcionário editados com sucesso']);
        }
        #endregion


    }


    protected function validatorEditar(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'cpf' => ['required', 'cpf', 'string', 'min:14', 'max:14'],
            'celular' => ['required', 'celular_com_ddd', 'string', 'min:14', 'max:14'],
            'cargo_setor' => ['required','string', 'max:50']
        ],[
            'name.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatório',
            'cpf.required' => 'CPF é obrigatório',
            'celular.required' => 'Celular é obrigatório',
            'cargo_setor.required' => 'Selecione um cargo'
        ]);
    }

    protected function updateFuncionario(array $data, $colunaAutorizacao)
    {
        $user = User::find($data['id_funcionario']);

        $user->name = $data['name'];
        $user->cpf = $data['cpf'];
        $user->email = $data['email'];
        $user->celular = $data['celular'];
        $user->cargo = $data['cargo'];
        $user->setor = $data['setor'];
        $user->$colunaAutorizacao = '1';

        $user->save();

    }


}
