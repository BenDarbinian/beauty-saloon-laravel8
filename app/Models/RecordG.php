<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordG extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function status() 
    {
        return $this->belongsTo(Status::class);
    }
}
