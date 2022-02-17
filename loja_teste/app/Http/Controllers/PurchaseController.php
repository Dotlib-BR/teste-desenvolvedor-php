<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    
    public function getPurchase()
    {
        $purchases = Purchase::where('active', 1)->get();
        return view("backend.purchase.list", ['purchases' => $purchases]);
    }

    public function getPurchaseDetail($id)
    {
        $purchase = Purchase::findOrFail($id);
        if($purchase)
            if($purchase->active)
                return view("backend.purchase.detail", ['purchase' => $purchase]);
            else
                abort(403);
        else
            abort(404);
    }
    
    public function getPurchaseCreate()
    {
        return view("backend.purchase.create");
    }

    public function getPurchaseEdit($id)
    {
        $purchase = Purchase::findOrFail($id);

        if($purchase)
            return view("backend.purchase.edit", ['purchase' => $purchase]);
        else
            abort(404);
    }

    public function postPurchaseCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'max:100|nullable',
            'barcode' => 'required|unique:Purchases|max:20|min:20',
            'amount' => 'required',
        ]);

        $amount_replace= str_replace(['.', ','], ['', '.'], $request->amount);

        $purchase = new Purchase();
        $purchase->name = $request->name;
        $purchase->barcode = $request->barcode;
        $purchase->amount = (double) $amount_replace;
        $purchase->active = 1;

        $purchase->save();

        return redirect('/purchases/list');
    }

    public function putPurchaseEdit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'max:100|nullable',
            'barcode' => 'required|max:20|min:20|unique:Purchases,barcode,'. $id,
            'amount' => 'required'
        ]);

        $purchase = Purchase::findOrFail($id);

        if($purchase)
        {
            $amount_replace= str_replace(['.', ','], ['', '.'], $request->amount);

            $purchase->name = $request->name;
            $purchase->barcode = $request->barcode;
            $purchase->amount = (double) $amount_replace;
            $purchase->save();

            return redirect('/purchases/list');
        }
        else
            abort(404);
    }

    public function putPurchaseDeactive($id)
    {
        $purchase = Purchase::findOrFail($id);
        if($purchase)
        {
            $purchase->active = 0;
            $purchase->save();

            return redirect('/purchases/list');
        }
        else
            abort(404);
    }

}
