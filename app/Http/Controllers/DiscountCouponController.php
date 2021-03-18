<?php

namespace App\Http\Controllers;

use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class DiscountCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(session()->has('cupom')){
            return back()->withErrors('Já há um cupom aplicado.');
        }

        $cupom = DiscountCoupon::where('code', $request->coupon_code)->first();
        $user = OrderProduct::where('user_id', $request->user_id)->first();
        $price = $request->cost;
        
        if ($cupom->value > $price){
            return back()->withErrors('Não é possível negativar o valor do produto.');
        }

        if (!$cupom){
            return back()->withErrors('Cupom inválido. Verifique e tente novamente.');
        }
        
        if ($user){
            return back()->withErrors('Esse cupom só é válido na sua primeira compra.');
        }
        
        session()->put('cupom', [
            'name' => $cupom->code,
            'discount' => $cupom->desconto($request->price),
        ]);

        
        return back()->with('success_message', 'O cupom '.$cupom->code . ' de ' . $cupom->value . ' reais foi aplicado com sucesso!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('cupom');

        return back()->with('success_message', 'O cupom foi removido com sucesso.');
    }

    public function forget()
    {
        //
    }
}
