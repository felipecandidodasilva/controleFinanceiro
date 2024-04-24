<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Item_lancamento extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'lancamento_id',
        'forma_pagamento_id',
        'valor',
        'parcela',
        'dt_vencimento',
        'pago',
        'obs',
    ];

    public function lancamento(): BelongsTo
    {
        return $this->belongsTo(Lancamento::class);
    }

    public function formaPagamento(): BelongsTo
    {
        return $this->belongsTo(FormaPagamento::class);
    }
}
