<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division_id',
    ];

    /**
     * Zone -> Division relationship
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Zone -> Districts relationship
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
