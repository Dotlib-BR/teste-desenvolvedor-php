<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AnuncioController extends Controller
{

    private $anuncio;
    private $vagasVinculos;

    public function __construct(Anuncio $anuncio, User $user)
    {
        $this->anuncio = $anuncio;
        $this->user = $user;
    }

    public function index()
    {
        $anuncios = $this->anuncio->get();
        return view('anuncios.index', compact('anuncios'));
    }

    public function create()
    {
        $empresas = $this->anuncio->with('empresa')->get();
        $tipo_contrato = array('CLT', 'Pessoa Jurídica', 'Freelancer');
        return view('anuncios.form',compact('empresas', 'tipo_contrato'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'empresa_id' => 'required',
            'titulo' => 'required|min:5|max:50',
            'descricao' => 'required|min:10|max:1000',
            'remuneracao' => 'required|numeric|between:1000, 500000',
            'tipo_vaga' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'empresa_id.required' => 'O campo empresa é obrigatório',
            'remuneracao.required' => 'O campo salário é obrigatório',
            'tipo_vaga.required' => 'O campo tipo de contrato é obrigatório',
            'titulo.min' => 'O título deve ter no mínimo 3 caracteres',
            'titulo.max' => 'O título deve ter no maxímo 50 caracteres',
            'descricao.min' => 'A descrição deve ter no mínimo 10 caracteres',
            'descricao.max' => 'A descrição deve ter no maxímo 1000 caracteres',
            'remuneracao.numeric' => 'O campo :attribute deve ser do tipo numérico',
            'remuneracao.between'=>'São valídos apenas valores entre 1000 a 500000'
        ];

        $validation = $this->validation($data, $rules, $feedback);

        if ($validation->fails()) {
            return redirect()->route('anuncio.create')
                ->withErrors($validation)
                ->withInput();
        }

        $anuncio = $this->anuncio->create($request->all());
        if($anuncio){
            return redirect()->back()->with('msg', 'Anúncio cadastrado com sucesso!');
        }
    }

    public function show(Request $request)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $anuncio = $this->anuncio->find($id);
        $empresas = $anuncio->with('empresa')->get();
        $tipo_contrato = array('CLT', 'Pessoa Jurídica', 'Freelancer');
        return view('anuncios.form',compact('empresas', 'tipo_contrato', 'anuncio'));
    }

    public function update(request $request, $id)
    {
        $anuncio = $this->anuncio->find($id);

        $rules = [
            'empresa_id' => 'required',
            'titulo' => 'required|min:5|max:50',
            'descricao' => 'required|min:10|max:1000',
            'remuneracao' => 'required|numeric|between:1000, 500000',
            'tipo_vaga' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'empresa_id.required' => 'O campo empresa é obrigatório',
            'remuneracao.required' => 'O campo salário é obrigatório',
            'tipo_vaga.required' => 'O campo tipo de contrato é obrigatório',
            'titulo.min' => 'O título deve ter no mínimo 3 caracteres',
            'titulo.max' => 'O título deve ter no maxímo 50 caracteres',
            'descricao.min' => 'A descrição deve ter no mínimo 10 caracteres',
            'descricao.max' => 'A descrição deve ter no maxímo 1000 caracteres',
            'remuneracao.numeric' => 'O campo :attribute deve ser do tipo numérico',
            'remuneracao.between'=>'São valídos apenas valores entre 1000 a 500000'
        ];

        $validation = $this->validation($request->all(), $rules, $feedback);

        if ($validation->fails()) {
            return redirect()->route('anuncio.create')
                ->withErrors($validation)
                ->withInput();
        }
        $atualizar = $anuncio->update($request->all());
        if($atualizar){
            return redirect()->back()->with('msg', 'Anúncio cadastrado com sucesso!');
        }
    }

    public function destroy($id)
    {
        $anuncio = $this->anuncio->find($id);
        $anuncio->delete();
        return redirect()->back()->with('msg','Anúncio apagado com sucesso!');
    }

    protected function validation(array $data, array $rules, array $feedback)
    {
        return Validator::make($data, $rules, $feedback);
    }
}
