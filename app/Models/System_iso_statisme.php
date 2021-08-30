<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_iso_statisme extends Model
{
    use HasFactory;
    protected $fillable=['rps','rps_qte','support_rps','support_rps_qte'];
}
