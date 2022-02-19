<?php

namespace App\Http\Controllers;

use App\Models\Produto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{

    public function index(Request $request)
    {


          $filter1 = $request->query('filter1');
          $filter2 = $request->query('filter2');
          $filter3 = $request->query('filter3');
          $filter4 = $request->query('filter4');

          if (!empty($filter1))
          {
              $produtos = Produto::sortable()
                  ->where('produtos.Nome_produto', 'like', '%'.$filter1.'%')
                  ->paginate(5);

              return view('produtos.index',['produtos' => $produtos])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);

          }
          else
          {
            if(!empty($filter2))
            {
                $produtos = Produto::sortable()
                    ->where('produtos.CodBarras', 'like', '%'.$filter2.'%')
                    ->paginate(5);

                return view('produtos.index',['produtos' => $produtos])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);

            }
            else
            {
                if(!empty($filter3))
                {
                    $produtos = Produto::sortable()
                        ->where('produtos.ValorUnitario', 'like', '%'.$filter3.'%')
                        ->paginate(5);

                    return view('produtos.index',['produtos' => $produtos])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);

                }

            }
              $produtos = Produto::sortable()
                  ->paginate(5);

              return view('produtos.index',['produtos' => $produtos])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);
          }

      }

      public function destroy($Id_Produto)
      {

        Produto::where('Id_Produto',$Id_Produto)->delete();
        return redirect()->route('produtos-index');
      }


     public function create()
     {
       return view('produtos.create');
     }
     public function store(Request $request)
     {

       Produto::create($request->all());
       return redirect()->route('produtos-index');

     }



    public function edit($Id_Produto)
   {
     $produtos = Produto::where('Id_Produto',$Id_Produto)->first();
     if(!empty($produtos))
     {
       return view('produtos.edit', ['produtos' =>$produtos]);
     }
     else{
       return redirect()->route('produtos-index');
     }
   }
   public function update(Request $request,$Id_Produto)
   {
       $data =[
          'Nome_produto' => $request->Nome_produto,
          'CodBarras' => $request->CodBarras,
          'ValorUnitario' => $request->ValorUnitario
       ];
       Produto::where('Id_Produto',$Id_Produto)->update($data);
       return redirect()->route('produtos-index');
   }



}
