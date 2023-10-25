<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $fillable = ['titulo', 'pdf','inicio','fin','estado'];
}
