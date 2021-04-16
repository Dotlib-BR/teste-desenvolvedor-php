<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use Image;

class ClientesDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = User::all();
        
        return view('admin.clientes')->with(compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.forms.form-cliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'cpf' => 'cpf|unique:users,cpf',
            'password' => 'required|min:8|max:20',
            'imagem'  =>'mimes:jpeg,jpg,JPG,png,gif|max:20000',
            'verificado' =>'integer|between:0,1|nullable'

        ]);
        if($validator->fails()) {
          //original - COnflito encontrado no redirect, alternativa no código abaixo
           // notify()->error('Não foi possível atualizar o cliente. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
            //return Redirect::back()->withErrors($validator)->with('autofocus', true);
            //gambi
            notify()->error('Não foi possível atualizar o cliente. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
            return view('admin.forms.form-cliente')->withErrors($validator)->with('autofocus', true);
            //end gambi
        
        }
          $usuario = new User();
          $usuario->name = $request->get('name');
          $usuario->email = $request->get('email');
          $usuario->cpf = $request->get('cpf');
             if($request->hasFile('imagem')){
                    $imagem_cliente = $request->file('imagem');
                    $filename = time() . '.' . $imagem_cliente->getClientOriginalExtension();
                    Image::make($imagem_cliente)->resize(400, 400)->save( public_path('/storage/profile-photos/' . $filename ) );
                    $usuario->profile_photo_path = 'profile-photos/'.$filename;
                }
            
              if($request->get('verificado') != null){
                    $usuario->email_verified_at = now();
                }
                
            
                    $usuario->password = Hash::make($request->get('password'));
                
                
            $usuario->save();
             //Original - Erro desconhecido no redirect. Código alternativo abaixo   
           // notify()->success('Alterações realizadas com Sucesso!','Sucesso');
           // return Redirect::back();
           //gambi
            notify()->success('Alterações realizadas com Sucesso!','Sucesso');
            return view('admin.forms.form-cliente');
           //gambi
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
        $usuario = User::find($id);
        $fotoGenerica = Self::fotoGenericaUsuario($usuario->id);
        if($usuario){
            return view('admin.cliente-detalhado')->with(compact('usuario','fotoGenerica'));
        
        }else{
            return redirect()->route('adminDashboard');
        }
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
      
        $usuario = User::find($id);
        if($usuario){
            $encryptado = Crypt::encryptString($usuario->id);
          
            return view('admin.forms.form-cliente')->with(compact('usuario','encryptado'));
        }else{
            return redirect()->route('adminDashboard');
        }
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
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$id,
            'cpf' => 'required|cpf|unique:users,cpf,'.$id,
            'password' => 'nullable|min:8|max:20',
            'imagem'  =>'mimes:jpeg,jpg,JPG,png,gif|max:20000',
            'verificado' =>'integer|between:0,1|nullable',

        ]);
        if($validator->fails()) {
            //gambi
            $usuario = User::find($id);
            if($usuario){
                $encryptado = Crypt::encryptString($usuario->id);
                notify()->error('Não foi possível atualizar o cliente. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
           
                return view('admin.forms.form-cliente')->with(compact('usuario','encryptado'))->withErrors($validator)->with('autofocus', true);
            }else{
                return redirect()->route('adminDashboard');
            }
            //gambi
            //erro na session, redirect back não estava retornando corretamente mensagens. Alternativa,retornar uma view  no código acima
         //   notify()->error('Não foi possível atualizar o cliente. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
           // return Redirect::back()->withErrors($validator)->with('autofocus', true);
        }
        $decryptado= Crypt::decryptString($request->seguro);
        $decryptado = (int)$decryptado;
        
        $usuario = User::find($id);
        
        if($usuario){
            if($usuario->id === $decryptado){
                
                $usuario->name = $request->get('name');
                $usuario->email = $request->get('email');
                $usuario->cpf = $request->get('cpf');
               if($request->hasFile('imagem')){
                    $imagem_cliente = $request->file('imagem');
                    $filename = time() . '.' . $imagem_cliente->getClientOriginalExtension();
                    Image::make($imagem_cliente)->resize(400, 400)->save( public_path('/storage/profile-photos/' . $filename ) );
                    $usuario->profile_photo_path = 'profile-photos/'.$filename;
                }
                if($usuario->email_verified_at == null){
                    if($request->get('verificado') != null){
                        $usuario->email_verified_at = now();
                    }
                }
                if($request->filled('password')){
                    $usuario->password = Hash::make($request->get('password'));
                }
                
                $usuario->save();
              
               //gambiarra
                    $encryptado = Crypt::encryptString($usuario->id);
                    notify()->success('Alterações realizadas com Sucesso!','Sucesso');
                    return view('admin.forms.form-cliente')->with(compact('usuario','encryptado'))->with('autofocus', true);
                
                //gambiarra
                //codigo original abaixo
              //  notify()->success('Alterações realizadas com Sucesso!','Sucesso');
               // return Redirect::back();
                
            }else{
                //ogirinal - Erro desconhecido de sessão - ALternativa no código abaixo
               // notify()->error('O sistema detectou uma violação de rota. Por segurança a requisição foi cancelada!');
               // return Redirect::back()->withErrors($validator)->with('autofocus', true);
               //gambi
               $encryptado = Crypt::encryptString($usuario->id);
                notify()->error('O sistema detectou uma violação de rota. Por segurança a requisição foi cancelada! Feche esta página e tente novamente');
                return view('admin.forms.form-cliente')->with(compact('usuario','encryptado'))->with('autofocus', true);
            //gambi
            }
            
        
        }else{
          
            notify()->error('Nenhum cliente encontrado para edição. Crie um cliente produto');
            redirect()->route('interno.clientes.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    protected function fotoGenericaUsuario($id)
    {
        $usuario = User::find($id);
        return 'https://ui-avatars.com/api/?name='.urlencode($usuario->name).'&color=7F9CF5&background=EBF4FF';
    }

   

}
