<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'zone_id',
    ];

    /**
     * District -> Zone relationship
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * District -> Upazilas relationship
     */
    public function upazilas(): HasMany
    {
        return $this->hasMany(Upazila::class);
    }
}
