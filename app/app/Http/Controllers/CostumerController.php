<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class CostumerController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Define this resource controller uses the CostumerPolicy class binding.

        $this->authorizeResource(Costumer::class, 'costumer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render("Costumers/Index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255"],
            "cpf" => ["required", "string", "max:14"],
        ]);

        $validated["user_id"] = Auth::user()->id;

        Costumer::create($validated);

        return Redirect::to("/costumers");
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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Costumer $costumer
     * @return RedirectResponse
     */
    public function update(Request $request, Costumer $costumer)
    {
        $validated = $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255"],
            "cpf" => ["required", "string", "max:14"],
        ]);

        $costumer->update($validated);

        return Redirect::to("/costumers");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Costumer $costumer
     * @return RedirectResponse
     */
    public function destroy(Costumer $costumer)
    {
        $costumer->delete();

        return Redirect::to("/costumers");
    }
}
