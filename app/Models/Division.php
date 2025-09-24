<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Division -> Zones relationship
     */
    public function zones(): HasMany
    {
        return $this->hasMany(Zone::class);
    }
}
