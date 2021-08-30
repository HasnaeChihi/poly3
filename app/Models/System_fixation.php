<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_fixation extends Model
{
    use HasFactory;
    protected $fillable=['user_id','str_type','str_qte','support_str_type','support_str_qte','clip_qte','bridage_qte'];
}
