<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upazila extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'district_id',
    ];

    /**
     * Upazila -> District relationship
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
