<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Request as RequestFacade;

use Inertia\Inertia;

class ProductController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render("Products", [
            "pagination" => Product::query()
                ->when(RequestFacade::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('barcode', 'like', '%' . $search . '%');
                })
                ->paginate(20, ["name", "barcode", "price", "id"])
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
            "modal" => [
                "active" => true,
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "price" => "required|numeric",
            "barcode" => "string|max:255"
        ]);

        Product::create($validated);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(Product $product)
    {
        return $this->index()->with([
            "modal" => [
                "active" => true,
                "product" => $product->only(["id", "name", "barcode", "price"])
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "price" => "required|numeric",
            "barcode" => "string|max:255"
        ]);

        $product->update($validated);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->index();
    }
}
