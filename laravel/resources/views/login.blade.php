<!doctype html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="{{url('bootstrap-4.3.1/css/bootstrap.min.css')}}">
  </head>
  <body>

    <div Class="container">
           
                {!! Form::open([
                                'method' => 'POST',
                                'action' => 'LoginController@authenticate',
                                'class'=>'col-md-6 bg-secondary',
                                'style'=>"margin:auto;margin-top:20%;border-radius:5px;padding:5%;"
                    ]) 
                !!}   
                <div class="form-group">
                    <label class="text-white">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Entre com e-mail" value="{{old('email')}}">
                  </div>
                  <div class="form-group">
                    <label class="text-white">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" value="{{old("password")}}">
                  </div>
                  <button type="submit" class="btn btn-primary">Entrar</button>
                {!!Form::close()!!}
    </div>
     

  </body>

</html>
