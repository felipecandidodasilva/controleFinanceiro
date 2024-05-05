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

    function valorTotalParcelas($lancamento_id) : float {

        return $this->where('lancamento_id',$lancamento_id)->sum('valor');
        
    }
    function valorTotalParcelasPagas($lancamento_id) : float {

        return $this->where('lancamento_id',$lancamento_id)->where('pago','S')->sum('valor');
        
    }
    function valorTotalParcelasAVencer($lancamento_id) : float {

        return $this->where('lancamento_id',$lancamento_id)->where('pago','N')->sum('valor');
        
    }
    public static function totalParcelas($lancamentoi_id): int {
        return Item_lancamento::where('lancamento_id',$lancamentoi_id)->count();
    }
}
