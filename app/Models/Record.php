<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function serviceHistory()
    {
        return $this->hasMany(ServiceHistory::class);
    }
    public function status() 
    {
        return $this->belongsTo(Status::class);
    }
}
