<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cout_mdc extends Model
{
    use HasFactory;
    protected $fillable=['nom','price'];
    
}
