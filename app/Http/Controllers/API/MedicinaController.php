<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Prescricao;


class MedicinaController extends Controller
{
    public function registrarPrescricao(Request $request) {

        $array = ['error' => ''];

        $dados = $request->only(['id_medico','id_paciente','itensPrescritos']);

        $itensPrescritos = json_decode($dados['itensPrescritos'], true);

        if (!$itensPrescritos['dieta'] && !$itensPrescritos['medicacoes'] && !$itensPrescritos['outros']) {
            
            $array['error'] = 'Não foi enviado nenhum item para salvar a prescrição';

            return json_encode($array);
        }

        $this->createPrescricao($dados);

        $array['idPrescricao'] = $this->getIdPrescricao($dados['id_medico']);

        return json_encode($array);
    }

    protected function createPrescricao(array $dados)
    {
        $prescricao = new Prescricao;

        $prescricao->id_medico = $dados['id_medico'];
        $prescricao->id_paciente = $dados['id_paciente'];
        $prescricao->prescricao = $dados['itensPrescritos'];

        $prescricao->save();
    }

    protected function getIdPrescricao($id_medico) 
    {
        $idPrescricao = Prescricao::where('id_medico', $id_medico)->orderBy('id', 'desc')->first();

        return $idPrescricao->id;
    }

}
