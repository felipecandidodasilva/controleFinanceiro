<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;


class FormaPagamento extends Model
{
    use HasFactory;
    protected $table = 'forma_pagamentos';
    protected $fillable = ['id','descricao','diacompra','diavencimento','ativo'];

    public function lancamentos(): HasMany
    {
        return $this->hasMany(Lancamento::class);
    }

    public function item_lancamento(): HasMany
    {
        return $this->hasMany(Item_lancamento::class);
    }
 
}
