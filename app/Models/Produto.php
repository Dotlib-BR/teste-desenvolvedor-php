<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomeProduto',
        'valorUnitario',
        'quantidade'
    ];

    public function rules()
    {
        $rules = [
            'nomeProduto' => 'max:100',
            'valorUnitario' => 'required',
            'quantidade' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'nomeProduto.max' => "O campo 'nomeProduto' possui um máximo de 100 caracteres.",
            'valorUnitario.required' => "O campo 'valorUnitario' é obrigatório.",
            'quantidade.required' => "O campo 'quantidade' é obrigatório.",
        ];
        return $messages;
    }

    public function showAll($request){
        $order = ($request->order ?? 'asc');
        $request->quantPagina = ($request->quantPagina ?? 20);
        switch ($request->orderCampo) {
            case ('id'):
                $campo = 'produtos.'.$request->orderCampo;
                break;
            case ('nomeProduto'):
                $campo = 'produtos.'.$request->orderCampo;
                break;
            case ('valorUnitario'):
                $campo = 'produtos.'.$request->orderCampo;
                break;
            case ('quantidade'):
                $campo = 'produtos.'.$request->orderCampo;
                break;
            default:
                $campo = 'produtos.id';
        }
        return self::select('id', 'nomeProduto', 'valorUnitario', 'quantidade')
            ->where(function ($query) use ($request){
                $query->orWhere('produtos.id', 'like','%'.$request->filtro.'%')
                    ->orWhere('produtos.nomeProduto', 'like','%'.$request->filtro.'%')
                    ->orWhere('produtos.valorUnitario', 'like','%'.$request->filtro.'%')
                    ->orWhere('produtos.quantidade', 'like','%'.$request->filtro.'%');
            })
            ->orderBy($campo, $order)
            ->paginate($request->quantPagina);
    }

    public function showOne($id){
        return self::select('id', 'nomeProduto', 'valorUnitario', 'quantidade')->where('id', $id)->first();
    }

    public function cadastro($request){
        $rules = $this->rules();
        $messages = $this->messages();

        $validate = Validator::make($request->all(), $rules, $messages);
        if ($validate->fails())
        {
            return response()->json($validate->errors()->messages(), 400);
        }

        if(self::create([
            'quantidade' => $request->quantidade,
            'valorUnitario' => $request->valorUnitario,
            'nomeProduto' => $request->nomeProduto ?? null
        ])){
            return response()->json([
                'message' => 'Cadastro realizado com sucesso!'
            ], 201);
        }

        return response()->json([
            'message' => 'Erro ao realizar o cadastro.'
        ], 400);
    }

    public function atualizar($request, $id){

        $validate = Validator::make($request->all(), $this->rules(), $this->messages());

        if(!self::where('id', $id)->exists() or $validate->fails()) {
            return response()->json([
                'message' => 'Dados inválidos.',
                'error' => $validate->fails() ? $validate->errors() : ['id' => 'Id inválido.']
            ], 400);
        }

        if(self::where('id', $id)->update($request->all())){
            return response()->json([
                'message' => 'Edição realizada com sucesso!'
            ], 200);
        }

        return response()->json([
            'message' => 'Erro ao realizar a edição.'
        ], 400);
    }

    public function deletar($id){
        if (!self::where('id', $id)->exists()){
            return response()->json([
                'message' => 'Produto não existe.'
            ], 400);
        }

        if(self::where('id', $id)->delete()){
            return response()->json([
                'message' => 'Produto deletado com sucesso!'
            ], 200);
        }

        return response()->json([
            'message' => 'Erro ao deletar produto.'
        ], 400);
    }
}
