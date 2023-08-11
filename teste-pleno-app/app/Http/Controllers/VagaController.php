<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Faca\Auth;
use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\Candidato;

class VagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Vaga::query();

        // Filtros
        if ($request->has('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }
        if ($request->has('tipo')) {
            $query->where('tipo', $request->tipo);
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('email')) {
            $query->whereHas('candidatos', function ($subquery) use ($request) {
                $subquery->where('email', 'like', '%' . $request->email . '%');
            });
        }


        // Ordenação
        $orderBy = $request->get('order_by', 'id');
        $orderDirection = $request->get('order_direction', 'asc');

        // Opções de ordenação para cada campo da vaga
        if ($orderBy === 'nome' || $orderBy === 'tipo' || $orderBy === 'status') {
            $query->orderBy($orderBy, $orderDirection);
        } elseif ($orderBy === 'candidatos') {
            $query->withCount('candidatos')->orderBy('candidatos_count', $orderDirection);
        }

        $vagas = $query->paginate(20);

        return view('vagas.index', compact('vagas'));
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function candidatarse(Request $request)
    {
        $query = Vaga::query();

        // Filtros
        if ($request->has('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }
        if ($request->has('tipo')) {
            $query->where('tipo', $request->tipo);
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('email')) {
            $query->whereHas('candidatos', function ($subquery) use ($request) {
                $subquery->where('email', 'like', '%' . $request->email . '%');
            });
        }


        // Ordenação
        $orderBy = $request->get('order_by', 'id');
        $orderDirection = $request->get('order_direction', 'asc');

        // Opções de ordenação para cada campo da vaga
        if ($orderBy === 'nome' || $orderBy === 'tipo' || $orderBy === 'status') {
            $query->orderBy($orderBy, $orderDirection);
        } elseif ($orderBy === 'candidatos') {
            $query->withCount('candidatos')->orderBy('candidatos_count', $orderDirection);
        }

        $vagas = $query->paginate(20);

        return view('vagas.candidatarse', compact('vagas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vagas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'tipo' => 'required',
            'status' => 'required',
            'email' => 'required|email',
        ]);

        Vaga::create($data);

        return redirect()->route('vagas.index')->with('success', 'Vaga criada com sucesso!');
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaga  $vaga
     * @return \Illuminate\Http\Response
     */
    public function show(Vaga $vaga)
    {
        $candidatosQuery = Candidato::where('vaga_id', $vaga->id);

        $nome = request()->input('nome');
        if ($nome) {
            $candidatosQuery->where('nome', 'like', "%$nome%");
        }

        $email = request()->input('email');
        if ($email) {
            $candidatosQuery->where('email', 'like', "%$email%");
        }

        $cpf = request()->input('cpf');
        if ($cpf) {
            $candidatosQuery->where('cpf', 'like', "%$cpf%");
        }

        $candidatos = $candidatosQuery->get();

        return view('vagas.show', compact('vaga', 'candidatos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaga  $vaga
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaga $vaga)
    {
        return view('vagas.edit', compact('vaga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaga  $vaga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaga $vaga)
    {
        $data = $request->validate([
            'nome' => 'required',
            'tipo' => 'required',
            'status' => 'required',
            'email' => 'required|email',
        ]);

        $vaga->update($data);

        return redirect()->route('vagas.index')->with('success', 'Vaga atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaga  $vaga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaga $vaga)
    {
        $vaga->delete();

        return redirect()->route('vagas.index')->with('success', 'Vaga excluída com sucesso!');
    }


    use RefreshDatabase;

    public function testListaVagas()
    {
        Vaga::factory()->count(3)->create();

        $response = $this->get(route('vagas.index'));

        $response->assertStatus(200);
        $response->assertViewIs('vagas.index');
        $response->assertViewHas('vagas');
    }
    public function detalhesVaga(Vaga $vaga)
{
    return view('vagas.detalhes', compact('vaga'));
}
    public function candidatos()
    {
        return $this->belongsToMany(Candidato::class, 'candidatos_vagas', 'vaga_id', 'candidato_id');
    }

    public function candidatar($id)
    {
        $vaga = Vaga::findOrFail($id);

        if (!$vaga->candidatos()->where('candidato_id', Auth::user()->id)->exists()) {
            $vaga->candidatos()->attach(Auth::user()->id);
            return redirect()->route('listar-vagas')->with('success', 'Candidatado com sucesso.');
        } else {
            return redirect()->route('listar-vagas')->with('error', 'Você já está candidatado para esta vaga.');
        }
    }





}
