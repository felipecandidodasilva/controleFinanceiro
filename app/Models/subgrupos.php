<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class subgrupos extends Model
{
    use HasFactory;
    protected $fillable = ['descricao','grupo_id'];

    public function grupo(): BelongsTo
        {
            return $this->belongsTo(grupos::class);
        }
}
