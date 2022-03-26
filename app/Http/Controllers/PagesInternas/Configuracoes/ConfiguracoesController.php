<?php

namespace App\Http\Controllers\PagesInternas\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ConfiguracoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexConfiguracoes()
    {
        return view('pagesInternas/Configuracoes/homeConfiguracoes');
    }

    public function redefinirSenha(Request $request)
    {
        $data = $request->only('password_atual', 'new_password', 'password_confirmation');

        $validator = $this->validator($data);

        $user = Auth::user();

        if( password_verify($data['password_atual'], $user->password)) {

            $user->password = Hash::make($data['new_password']);

        } else {

            $validator->errors()->add('password_atual', 'Senha Atual incorreta');
        }


        if($data['new_password'] != $data['password_confirmation']) {

            $validator->errors()->add('password_confirmed', 'A [Nova Senha] e a [Confirmação da Nova Senha] não correspondem');

        }


        if( count($validator->errors()) > 0 ) {

            return redirect()->route('configuracoes')
            ->with('showRedefinirSenha', true)
            ->withErrors($validator)
            ->withInput();

        } else {

            $user->save();

            return redirect()->route('configuracoes')
            ->with([
                'msgSuccess' => 'Senha alterada com sucesso',
                'showRedefinirSenha' => true,
            ]);
        }
        
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'password_atual' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ],
        [
            'password_atual.required' => 'A Senha Atual é obrigatória.',
            'new_password.required' => 'A Nova Senha é obrigatória.',
            'new_password.min' => 'A Nova Senha deve ter no mínimo 8 caracteres.',
            'password_confirmation.required' => 'A Confirmação de Senha é obrigatória.',
            'password_confirmation.min' => 'A Confirmação de Senha deve ter no mínimo 8 caracteres.',

        ]);
    } 
}
