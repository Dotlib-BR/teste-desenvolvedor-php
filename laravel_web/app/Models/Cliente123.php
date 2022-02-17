<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $nome
 * @property $email
 * @property $cpf
 * @property $celular
 * @property $data_nascimento
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Pedido[] $pedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    use HasFactory;

    static $rules = [
      'nome' => 'required',
      'email' => 'required',
      'cpf' => 'required',
      'data_nascimento' => 'required',
      'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nome','email','cpf','celular','data_nascimento','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido', 'cliente_id', 'id');
    }
    

}
