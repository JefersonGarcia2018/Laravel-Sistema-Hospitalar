<?php

namespace App\Http\Controllers\PagesExternas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function loginIndex()
    {
        return view('pagesExternas/login');
    }

    public function loginAction(Request $request)
    {
        
        $data = $request->only(['email','password']);

        $validator = $this->validator($data);

        $remember = $request->input('remember', false);

        if($validator->fails())
        {
            return redirect()->route('login')
            ->withErrors($validator)
            ->withInput();

        }

        if (Auth::attempt($data, $remember)) 
        {     
            $request->session()->regenerate();

            return redirect()->route('/');
        }
        else
        {
            return redirect()->back()
            ->with('danger', 'Email e/ou Senha inválidos')
            ->withInput();    
        }

    }


    protected function validator(array $data)
    {

        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ],
        [
            'email.required' => 'O Email é obrigatório.',
            'email.email' => 'O campo Email não contém um email válido.',
            'password.required' => 'A Senha é obrigatória.',
        ]);
    } 



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
