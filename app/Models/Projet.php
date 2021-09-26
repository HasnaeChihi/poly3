<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $casts = [

        'created_at' => 'datetime:Y-m-d H:i',
    ];
    protected $fillable=['user_id','famille_id','ngo_id','comparateur_id','fixation_id','iso_statisme_id','cout_mdc_id','nom','client','client_final','id_designation','nbr_mdc','type_mdc'];
}
