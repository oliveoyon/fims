<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'tender_id','school_id','inspector_id','work_description','work_status',
        'progress_percentage','observation','recommendation','latitude','longitude',
        'images','videos','is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'videos' => 'array',
        'is_active' => 'boolean'
    ];

    public function tender() { return $this->belongsTo(Tender::class); }
    public function school() { return $this->belongsTo(School::class); }
    public function inspector() { return $this->belongsTo(User::class,'inspector_id'); }
}
