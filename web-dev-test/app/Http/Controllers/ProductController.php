<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('id','DESC')->paginate(200);
        return view('product.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['price'] = $this->getAmount($request['price']);
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'bar_code' => 'required',
            'quantity' => 'required',
        ]);

        Product::create($request->all());

        return redirect()
        	->route('products.index')
            ->with('success','Produto inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit',compact('product'));
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
        $request['price'] = $this->getAmount($request['price']);
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'bar_code' => 'required',
            'quantity' => 'required',
        ]);

        Product::find($id)->update($request->all());
        return redirect()
            ->route('products.index')
            ->with('success','Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->delete();
    	return back()->with('success','Produto excluído com sucesso!');
    }

    public function getProduct() {

        $term = Str::lower(Input::get('term'));
        $data = Product::orderBy('id', 'ASC')->get();
        $return_array = array();
    
        foreach ($data as $k => $v) {
            if (strpos(Str::lower($v), $term) !== FALSE) {
                $return_array[] = array(
                  'value' => $v->name,
                  'price' =>$v->price,
                  'barcode' => $v->bar_code,
                  'pid' => $v->id,
                  'qtt' => $v->quantity,
                  'name' => $v->name,
                  'prod' => $v
                );
            }
        }
        return $return_array;
    }

    public function getAmount($money)
    {
        $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousendSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);

        return (float) str_replace(',', '.', $removedThousendSeparator);
    }
}
