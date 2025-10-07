<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'component_id',
        'tenderer_id',
        'description',
        'start_date',
        'end_date',
        'is_active'
    ];

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function tenderer()
    {
        return $this->belongsTo(Tenderer::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_tender', 'tender_id', 'school_id');
    }
}
