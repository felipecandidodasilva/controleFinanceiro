<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class subgrupos extends Model
{
    use HasFactory;
    protected $fillable = ['descricao','grupo_id','cota'];

    public function grupo(): BelongsTo
        {
            return $this->belongsTo(grupos::class);
        }

        /**
         * Get all of the comments for the subgrupos
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function lancamentos(): HasMany
        {
            return $this->hasMany(lancamento::class);
        }

        public static function criaSaidaRapida() : int {
            $subgrupo = subgrupos::create([
                    'descricao' => 'Saída Rápida',
                    'grupo_id'  => 1
            ]);

            return $subgrupo->id;
        }
}
