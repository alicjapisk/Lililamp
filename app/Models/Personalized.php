<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personalized extends Model
{
    public $timestamps = false; 
    protected $table = 'personalized';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_color',
        'leaf_color',
        'additional_word',
        'power_supply',
        'child_name'
    ];
}
