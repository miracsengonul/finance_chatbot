<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bakiye extends Model
{
    public $timestamps = false;
    protected $table = 'hesap';
    protected $fillable = ['user_id', 'bakiye'];
}
