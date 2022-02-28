<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Cadastros extends Model
{
    // Nome da tabela
    protected $table = 'cadastros';

    // Nome do ID
    protected $primaryKey = 'cadastroId';
    // ID será AI (auto generate)
    public $increment = true;

    // Colunas da tabela
    protected $fillable = [
        // Nenhum dado é passível de ser alterado por enquanto
        'cadastroCpf',
        'cadastroNome',
        'cadastroEmail',
        'cadastroSenha',
        'cadastroAutoridade',
        'cadastroToken',
        'created_at',
        'updated_at'
    ];

    // Colunas de created_at e updated_at
    public $timestamps = true;
}