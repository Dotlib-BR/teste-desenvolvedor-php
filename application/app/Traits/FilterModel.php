<?php

namespace App\Traits;

trait FilterModel
{

    public function scopeFilter($query)
    {
        $input = array_filter(request()->all());

        if (isset($input['q'])) {
            $query->where(function ($q) use ($input) {
                return $q->where('nome', 'like', '%' . $input['q'] . '%')->orWhere('email', $input['q'])->orWhere('cpf', $input['q']);
            });
        }

        if (isset($input['nome'])) {
            $query->where('nome', 'like', '%' . $input['nome'] . '%');
        }

        if (isset($input['cpf'])) {
            $query->where('cpf', $input['cpf']);
        }

        if (isset($input['email'])) {
            $query->whereEmail($input['email']);
        }

        return $query;
    }
}
