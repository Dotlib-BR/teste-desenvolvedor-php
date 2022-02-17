<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'email'
    ];

    public function rules()
    {
        $rules = [
            'nome' => 'required|max:100|string',
            'cpf' => 'required|max:11|unique:clientes|string',
            'email' => 'max:255'
        ];
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'nome.required' => "O campo 'nome' é obrigatório.",
            'nome.max' => "O campo 'nome' possui um máximo de 100 caracteres.",
            'cpf.required' => "O campo 'cpf' é obrigatório.",
            'cpf.max' => "O campo 'cpf' possui um máximo de 11 caracteres.",
            'cpf.unique' => "Já possui um cliente com o mesmo CPF cadastrado. Por favor, insira outro CPF.",
        ];
        return $messages;
    }

    public function showAll($request){
        $order = ($request->order ?? 'asc');
        $request->quantPagina = ($request->quantPagina ?? 20);
        switch ($request->orderCampo) {
            case ('id'):
                $campo = 'clientes.'.$request->orderCampo;
                break;
            case ('nome'):
                $campo = 'clientes.'.$request->orderCampo;
                break;
            case ('email'):
                $campo = 'clientes.'.$request->orderCampo;
                break;
            default:
                $campo = 'clientes.id';
        }
        return self::select('id', 'nome', 'email')
            ->where(function ($query) use ($request){
                $query->orWhere('clientes.id', 'like','%'.$request->filtro.'%')
                    ->orWhere('clientes.nome', 'like','%'.$request->filtro.'%')
                    ->orWhere('clientes.email', 'like','%'.$request->filtro.'%');
            })
            ->orderBy($campo, $order)
            ->paginate($request->quantPagina);
    }

    public function showOne($id){
        return self::select('id', 'nome', 'email')->where('id', $id)->first();
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
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email ?? null
        ])){
            return response()->json([
                'message' => 'Cadastro realizado com sucesso!'
            ], 201);
        }
        return response()->json([
            'message' => 'Erro ao realizar cadastro.'
        ], 400);
    }

    public function atualizar($request, $id){

        $validate = Validator::make($request->all(), ['nome' => 'required|max:100'], $this->messages());

        if(!self::where('id', $id)->exists() or $validate->fails()) {
            return response()->json([
                'message' => 'Dados inválidos.',
                'error' => $validate->fails() ? $validate->errors() : ['id' => 'Id inválido.']
            ], 400);
        }

        if(self::where('id', $id)->update([
            'nome' => $request->nome,
            'email' => $request->email
        ])){
            return response()->json([
                'message' => 'Edição realizada com sucesso!'
            ], 200);
        }

        return response()->json([
            'message' => 'Erro ao realizar edição.'
        ], 400);
    }

    public function deletar($id){
        if (!self::where('id', $id)->exists()){
            return response()->json([
                'message' => 'Cliente não existe.'
            ], 400);
        }

        if(self::where('id', $id)->delete()){
            return response()->json([
                'message' => 'Cliente deletado com sucesso!'
            ], 200);
        }

        return response()->json([
            'message' => 'Erro ao deletar cliente.'
        ], 400);
    }
}
