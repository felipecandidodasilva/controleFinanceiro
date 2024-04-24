<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lancamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'subgrupo_id',
        'forma_pagamento_id',
        'valor',
        'total_parcelas',
        'dt_compra',
        'obs',
        'tipo_lancamento'
    ];

    public function subgrupo(): BelongsTo
    {
        return $this->belongsTo(subgrupos::class);
    }
    public function formaPagamento(): BelongsTo
    {
        return $this->belongsTo(FormaPagamento::class);
    }
    public function item_lancamento(): HasMany
    {
        return $this->hasMany(Item_lancamento::class);
    }
}
