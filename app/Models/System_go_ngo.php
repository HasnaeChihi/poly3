<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_go_ngo extends Model
{
    use HasFactory;
    protected $fillable=['user_id','qte_bm','support_bm','nbr_bm'];
}
