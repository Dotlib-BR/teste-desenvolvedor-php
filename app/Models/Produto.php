<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use BeyondCode\Vouchers\Traits\HasVouchers;

class Produto extends Model
{
    use HasFactory;
    protected $table = "produtos"; 
    use SoftDeletes;
    use HasVouchers;
    protected $dates = ['deleted_at'];
    protected $fillable = ['nome_produto','slug','descricao','valor_unitario','preco_promocional','sku','cod_barras','status_estoque','quantidade_estoque','imagem','categoria_id'];

   
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function pedidoProdutos(){
        return  $this->hasMany('\App\Models\PedidoProduto','id','pedido_id');
      }
    

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // ... code here
            if($model->quantidade_estoque < 1 ){
                $model->status_estoque = 'indisponivel';
            }
            
        });

        self::created(function($model){
            // ... code here

           
        });

        self::updating(function($model){
            // ... code here
            if($model->quantidade_estoque < 1 ){
                $model->status_estoque = 'indisponivel';
            }
           
        });

        self::updated(function($model){
           
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }
}

