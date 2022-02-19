<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Request as RequestFacade;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class CostumerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render("Costumers", [
            "pagination" => Costumer::query()
                ->when(RequestFacade::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('cpf', 'like', '%' . $search . '%');
                })
                ->paginate(20, ['name', 'email', 'cpf', 'id'])
                ->appends(RequestFacade::except('page')),
            "filters" => RequestFacade::query()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->index()->with([
            "modal" => ["active" => true]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Inertia\Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255"],
            "cpf" => ["required", "string", "max:14"],
        ]);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Costumer $costumer
     * @return \Inertia\Response
     */
    public function edit(Costumer $costumer)
    {
        return $this->index()->with([
            "modal" => [
                "active" => true,
                "costumer" => $costumer->only(["id", "name", "email", "cpf"])
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Costumer $costumer
     * @return \Inertia\Response
     */
    public function update(Request $request, Costumer $costumer)
    {
        $validated = $request->validate([
            "id" => ["required", "integer"],
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255"],
            "cpf" => ["required", "string", "max:14"],
        ]);

        $costumer->update($validated);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Costumer $costumer
     * @return \Inertia\Response
     */
    public function destroy(Costumer $costumer)
    {
        $costumer->delete();

        return $this->index();
    }
}
