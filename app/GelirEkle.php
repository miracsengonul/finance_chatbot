<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GelirEkle extends Model
{
    public $timestamps = false;
    protected $table = 'gelir';
    protected $fillable = ['user_id', 'miktar', 'para_birimi', 'aciklama', 'tarih', 'time'];
}
