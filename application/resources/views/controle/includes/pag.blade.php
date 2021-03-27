{!! Form::open(request()->all(), ['route' => null]) !!}
    por página {!! Form::select('pag', [10 => 10, 20 => 20, 50 => 50, 100 => 100], null, ) !!}
{!! Form::close() !!}
