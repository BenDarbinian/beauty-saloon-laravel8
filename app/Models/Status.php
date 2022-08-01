<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'bootColor',
        'vueColor',
    ];
    public function record()
    {
        return $this->hasMany(Record::class);
    }
    public function recordG()
    {
        return $this->hasMany(RecordG::class);
    }
}
