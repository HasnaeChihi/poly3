<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_comparateur extends Model
{
    use HasFactory;
    protected $fillable=['user_id','qte_pc','qte_support','nbr_pc'];
}
