<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'integer',
            'search_params',
        ]);


        if(session('success_message')) {
            Alert::success('Sucesso!', session('success_message'));
        }

        $per_page = $request->input('per_page') ?: 20;
        $search_params = $request->input('search_params');

        if ($search_params) {
            $discounts = Discount::advancedSearch($search_params)->paginate($per_page);
        } else {
            $discounts = Discount::paginate($per_page);
        }

        return view('discounts.index', [
            'discounts' => $discounts->appends(request()->input()),
            'per_page' => $per_page,
            'searchable' => true,
            'search_params' => $search_params
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'code' => 'required|string|digits:7|unique:App\Models\Discount,code',
            'value_off' => 'required_without:value_off|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'percent_off' => 'required_without:percent_off',
        ]);

        Discount::create($validation);
        return redirect(route('discounts.index'))
            ->withSuccessMessage('Desconto criado com sucess');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::find($id);

        return view('discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'code' => 'string|digits:7',
            'value_off' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|nullable',
            'percent_off' => 'numeric|nullable',
        ]);
        
        Discount::find($id)->update($validation);

        return redirect(route('discounts.index'))->withSuccessMessage('Desconto editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::find($id)->delete();
        return redirect(route('discounts.index'))->withSuccessMessage('Desconto apagado com sucesso');
    }
}
