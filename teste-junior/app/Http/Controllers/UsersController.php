<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    
    public function index(Request $request)
    {


          $filter1 = $request->query('filter1');
          $filter2 = $request->query('filter2');
          $filter3 = $request->query('filter3');
          $filter4 = $request->query('filter4');

          if (!empty($filter1))
          {
              $users = User::sortable()
                  ->where('users.name', 'like', '%'.$filter1.'%')
                  ->paginate(5);

              return view('users.index',['users' => $users])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);

          }
          else
          {
            if(!empty($filter2))
            {
                $users = User::sortable()
                    ->where('users.segundo_nome', 'like', '%'.$filter2.'%')
                    ->paginate(5);

                return view('users.index',['users' => $users])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);

            }
            else
            {
                if(!empty($filter3))
                {
                    $users = User::sortable()
                        ->where('users.cpf', 'like', '%'.$filter3.'%')
                        ->paginate(5);

                    return view('users.index',['users' => $users])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);

                }
                else
                {
                  if(!empty($filter4))
                  {
                      $users = User::sortable()
                          ->where('users.email', 'like', '%'.$filter4.'%')
                          ->paginate(5);

                      return view('users.index',['users' => $users])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);

                  }
                }
            }
              $users = User::sortable()
                  ->paginate(5);

              return view('users.index',['users' => $users])->with('filter1', $filter1)->with('filter2', $filter2)->with('filter3', $filter3)->with('filter4', $filter4);
          }

      }

      public function destroy($Id_cliente)
      {

        User::where('Id_cliente',$Id_cliente)->delete();
        return redirect()->route('users-index');
      }


     public function create()
     {
       return view('users.create');
     }
     public function store(Request $request)
     {

       User::create($request->all());
       return redirect()->route('users-index');

     }



    public function edit($Id_cliente)
   {
     $users = User::where('Id_cliente',$Id_cliente)->first();
     if(!empty($users))
     {
       return view('users.edit', ['users' =>$users]);
     }
     else{
       return redirect()->route('users-index');
     }
   }
   public function update(Request $request,$Id_cliente)
   {
       $data =[
          'name' => $request->name,
          'segundo_nome' => $request->segundo_nome,
          'cpf' => $request->cpf,
          'email' => $request->email
       ];
       User::where('Id_cliente',$Id_cliente)->update($data);
       return redirect()->route('users-index');
   }



}
