<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiderEkle extends Model
{
    public $timestamps = false;
    protected $table = 'gider';
    protected $fillable = ['user_id', 'miktar', 'para_birimi', 'aciklama', 'tarih', 'time'];
}
