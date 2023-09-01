<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\Forgot;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function show(Request $request, $token) {
        ## obtem os dados do usuário na tabela de requisições de troca da senha ##
        if (!DB::table('password_resets')->where('token','=', $token)->count() == 0) {
        $dados = Forgot::where('token', '=', $token)
        ->orderBy('email','asc')
        ->take(1)
        ->get();
        $email = strtolower($dados[0]['email']);
        $token = $dados[0]['token'];

        return view('auth.forgetPasswordLink', ['email' => $email,'token' => $token]);
        }else{
            return redirect('/fpassword')->with('message', 'Link expirado, por gentileza tente novamente, obrigado!');
        }
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function register(Request $request)
      {

          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:4|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect('/login')->with('message', 'Your password has been changed!');
      }
}
