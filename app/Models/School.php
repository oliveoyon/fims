<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id', 'zone_id', 'district_id', 'upazila_id',
        'name', 'address', 'phone', 'geo_location', 'is_active'
    ];

    public function division() { return $this->belongsTo(Division::class); }
    public function zone() { return $this->belongsTo(Zone::class); }
    public function district() { return $this->belongsTo(District::class); }
    public function upazila() { return $this->belongsTo(Upazila::class); }
}
