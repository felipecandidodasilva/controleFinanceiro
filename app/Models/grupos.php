<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class grupos extends Model
{
    use HasFactory;
    /**
     * Get all of the comments for the grupos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    protected $fillable = ['descricao'];

    public function subgrupos(): HasMany
    {
        return $this->hasMany(subgrupos::class);
    }
}
