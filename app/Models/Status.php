<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    const TO_DO=1;
    const IN_PROGRESS=2;
    const DONE=3;
    
    protected $table = 'status';
    protected $fillable = ['name'];
}
