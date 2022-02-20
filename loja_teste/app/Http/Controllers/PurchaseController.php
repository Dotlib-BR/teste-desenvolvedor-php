<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{

    public function getPurchase()
    {
        $purchases = Purchase::where('active', 1)
            ->with('products')
            ->with('client')
            ->get();
        return view("backend.purchase.list", ['purchases' => $purchases]);
    }

    public function getPurchaseDetail($id)
    {
        $purchase = Purchase::findOrFail($id);
        if ($purchase)
            if ($purchase->active)
                return view("backend.purchase.detail", ['purchase' => $purchase]);
            else
                abort(403);
        else
            abort(404);
    }

    public function getPurchaseCreate()
    {
        $products = Product::where('active', 1)->get();
        return view("backend.purchase.create", ['products' => $products]);
    }

    public function getPurchaseEdit($id)
    {
        $purchase = Purchase::findOrFail($id);

        if ($purchase)
            return view("backend.purchase.edit", ['purchase' => $purchase]);
        else
            abort(404);
    }

    public function postPurchaseCreate(Request $request)
    {

        $validated = $request->validate([
            'clientId' => 'required',
            'productsId' => 'required',
            'productsQuantity' => 'required',
            'productsAmount' => 'required',
            'purchaseAmount' => 'required'
        ]);

        $purchase = new Purchase();
        $purchase->client_id = $request->clientId;
        $purchase->date = now();
        $purchase->amount = $request->purchaseAmount;
        $purchase->active = 1;
        $purchase->save();

        $products_id = $request->productsId;
        $products_qtd = $request->productsQuantity;
        $products_amount = $request->productsAmount;


        for ($i = 0; $i < sizeof($products_id); $i++) {
            DB::insert(
                'insert into purchases_products (purchase_id, product_id, quantity, product_price) values (?, ?, ?, ?)',
                [$purchase->id, (int) $products_id[$i], (float) $products_qtd[$i], (float) $products_amount[$i]]
            );
        }

        return redirect('/purchase/list');
    }

    public function putPurchaseEdit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'max:100|nullable',
            'barcode' => 'required|max:20|min:20|unique:Purchases,barcode,' . $id,
            'amount' => 'required'
        ]);

        $purchase = Purchase::findOrFail($id);

        if ($purchase) {
            $amount_replace = str_replace(['.', ','], ['', '.'], $request->amount);

            $purchase->name = $request->name;
            $purchase->barcode = $request->barcode;
            $purchase->amount = (float) $amount_replace;
            $purchase->save();

            return redirect('/purchases/list');
        } else
            abort(404);
    }

    public function putPurchaseDeactive($id)
    {
        $purchase = Purchase::findOrFail($id);
        if ($purchase) {
            $purchase->active = 0;
            $purchase->save();

            return redirect('/purchases/list');
        } else
            abort(404);
    }
}
