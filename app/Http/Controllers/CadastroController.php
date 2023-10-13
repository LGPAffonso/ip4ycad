<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
// use intl

class CadastroController extends Controller
{
    public function index()
    {
        return view('cadastro');
    }

    public function store(Request $request)
    {

        $usuario = new Usuario();

        $usuario->nome = $request->txtnome;
        $usuario->sobrenome = $request->txtsbrnome;
        $usuario->cpf = preg_replace('/[^0-9]/is', '', $request->txtcpf);
        $usuario->email = $request->txtemail;
        $usuario->dtanasc = implode("-", array_reverse(explode("/", $request->txtdtanasc)));
        // $usuario->dtanasc = $request->txtdtanasc;
        $usuario->genero = $request->slctgen;


        $msg = $this->validacao($usuario, $request);

        if ($msg["erro"]) {
            return redirect('/')->with('msg', $msg['msg']);
        } else {
            if ($request->flginc) {
                $exist = Usuario::firstWhere('cpf', $usuario->cpf);
                if ($exist) {
                    $msg['msg'][] = "Cpf já cadastrado.";
                } else {
                    $usuario->save();
                    $msg['msg'][] = "Usuario inserido com sucesso.";
                }
                return redirect('/')->with('msg', $msg['msg']);
            }
        }
    }

    public function validacao($usuario, $request)
    {
        $msg = array();
        $flg_erro = false;

        if (empty($usuario->nome)) {
            $msg[] .= "Nome não inserido. \n";
            $flg_erro = true;
        }
        if (empty($usuario->sobrenome)) {
            $msg[] .= "sobrenome não inserido. \n";
            $flg_erro = true;
        }
        $cpf = $usuario->cpf;
        if (empty($usuario->cpf) || strlen($cpf) != 11) {
            $msg[] .= "CPF invalido. \n";
            $flg_erro = true;
        } else {
            for ($i = 9; $i < 11; $i++) {
                for ($j = 0, $k = 0; $k < $i; $k++) {
                    $j += $cpf[$k] * (($i + 1) - $k);
                }
                $j = ((10 * $j) % 11) % 10;
                if ($cpf[$k] != $j) {
                    $msg[] .= "CPF invalido. \n";
                    $flg_erro = true;
                }
            }
        }
        $email = filter_var($usuario->email, FILTER_VALIDATE_EMAIL);
        if (empty($usuario->email)) {
            $msg[] .= "Email não inserido. \n";
            $flg_erro = true;
        } else if (!$email) {
            $msg[] .= "Email inválido. \n";
            $flg_erro = true;
        }
        if (empty($usuario->genero) || $usuario->genero === 0) {
            $msg[] .= "Gênero não inserido. \n";
            $flg_erro = true;
        }
        $now = now("america/Sao_paulo");
        if (empty($usuario->dtanasc)) {
            $msg[] .= "Data de nascimento não inserida. \n";
            $flg_erro = true;
        }

        if ($usuario->dtanasc > $now) {
            $msg[] .= "Data de nascimento inválida. \n"; // a parte de "data válida" ficou um pouco vaga então eu limitei a data atual
            $flg_erro = true;
        }
        $resp['msg'] = $msg;
        $resp['erro'] = $flg_erro;
        return $resp;
    }

    public function listagem()
    {
        $usuarios = Usuario::all();
        return view('listagem', ["usuarios" => $usuarios]);
    }

    public function remove($id)
    {
        Usuario::find($id)->delete();

        $msg['msg'][] = "Usuario excluido com sucesso.";
        return redirect('/listagem')->with('msg', $msg['msg']);
    }
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        $usuario->dtanasc = implode("/", array_reverse(explode("-", $usuario->dtanasc)));
        return view('/cadastro', ["usuario" => $usuario]);
    }
    public function update(Request $request)
    {
        $usuario = new Usuario();

        $usuario->nome = $request->nome;
        $usuario->sobrenome = $request->sobrenome;
        $usuario->cpf = preg_replace('/[^0-9]/is', '', $request->cpf);
        $request['cpf'] = preg_replace('/[^0-9]/is', '', $request->cpf);
        $usuario->email = $request->email;
        $usuario->dtanasc = implode("-", array_reverse(explode("/", $request->dtanasc)));
        $request['dtanasc'] = implode("-", array_reverse(explode("/", $request->dtanasc)));
        $usuario->genero = $request->genero;


        $msg = $this->validacao($usuario, $request);

        if ($msg["erro"]) {
            return redirect('/listagem')->with('msg', $msg['msg']);
        } else {
            unset($request['flginc']);
            Usuario::findOrFail($request->id)->update($request->all());
            $msg['msg'][] = "Usuario alterado com sucesso.";
            return redirect('/listagem')->with('msg', $msg['msg']);
        }
    }

    public function api()
    {
        $usuarios = Usuario::all();

        // $new_usuarios = json_encode($usuarios);

        Http::withBody(json_encode($usuarios), 'application/json')
            ->post('https://api-teste.ip4y.com.br/cadastro');
    }
}
