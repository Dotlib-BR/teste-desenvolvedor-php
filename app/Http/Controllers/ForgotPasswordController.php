<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Forgot;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function show()
      {
         return view('auth.forgetPassword');
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function register(ForgotRequest $request)
      {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        $request['token'] = $token;

        if (!DB::table('password_resets')->where('email','=', $request['email'])->count() == 0) {
            $password_resets = Forgot::where('email', $request['email'])->first();
            $password_resets->delete();
            // DB::table('password_resets')->insert([
            //     'email' => $request['email'],
            //     'token' => $request['token'],
            // ]);
        }
        Forgot::create($request->only('email','token'));


        Mail::send('email.forgetPassword', ['token' => $request['token']], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
      }

}
