<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Models\VagasVinculo;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use DB;

class VagasVinculoController extends Controller
{
    public function __construct(VagasVinculo $vagasVinculos, Anuncio $anuncio, User $user)
    {
        $this->vagasVinculos = $vagasVinculos;
        $this->anuncio = $anuncio;
        $this->user = $user;
    }

    public function anunciosList()
    {
        $title = 'Todos os Anúncios';
        $infoVaga = $this->user->with('anuncio')->get();
        $anunciosUser = DB::table('vagas_vinculos AS vv')
            ->select('vv.user_id', 'vv.anuncio_id')
            ->join('users AS us','us.id','=','vv.user_id')
            ->join('anuncios AS a','a.id','=','vv.anuncio_id')
            ->where('us.id','=',auth()->user()->id)
            ->get();

            /**CONSULTA PRA MINHA VAGAS */
            /*
            SELECT a.titulo AS titulo, a.descricao AS descricao, a.remuneracao AS remuneracao, a.tipo_vaga AS tipo_vaga, a.created_at AS created_at, e.nome AS nome_empresa FROM anuncios AS a INNER JOIN vagas_vinculos vv ON a.id = vv.anuncio_id INNER JOIN empresas AS e ON e.id=a.empresa_id;

            */
            $anuncios = DB::table('anuncios AS a')
                ->select('a.id AS id','a.titulo AS titulo',
                'a.descricao AS descricao',
                'a.remuneracao AS remuneracao',
                'a.tipo_vaga AS tipo_vaga',
                'a.created_at AS created_at',
                'e.nome AS nome_empresa')
                ->join('vagas_vinculos AS vv', 'a.id', '<>', 'vv.anuncio_id')
                ->join('empresas  AS e','e.id','=','a.empresa_id')
                ->where('vv.user_id','=',auth()->user()->id)
                ->paginate(4);
        return view('anuncios.listagem.index', compact('title','anuncios'));
    }

    public function anunciosChecked($id)
    {
        $title = 'Candidatar';
        $anuncio = $this->anuncio->find($id);
        return view('anuncios.candidatar.index',compact('title', 'anuncio'));
    }

    public function anunciosCandidadoVinculo(Request $request)
    {

        $anuncio_id = $request->anuncio_id;
        $usuario_id = $request->usuario_id;

        $consulta = $this->vagasVinculos
            ->where('user_id', '=', $usuario_id)
            ->where('anuncio_id', '=', $anuncio_id)
            ->get();


            if ($consulta) {
                $this->vagasVinculos->create([
                    'user_id' => $usuario_id,
                    'anuncio_id' => $anuncio_id
                ]);
            return redirect()->back()->with('msg', 'Usuário cadastrado a vaga com sucesso');
        } else {
            return redirect()->back()->with('msg', 'Usuário já esta cadastrado nesta vaga');
        }
    }


}
