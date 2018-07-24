<?php

namespace App\Http\Controllers;

use App\GelirEkle;

class GelirEkleController extends Controller
{
    public static function store($user_id, $miktar, $para_birimi, $aciklama)
    {
        $gelirEkle = new GelirEkle();
        $gelirEkle->user_id = $user_id;
        $gelirEkle->miktar = $miktar;
        $gelirEkle->para_birimi = $para_birimi;
        $gelirEkle->aciklama = $aciklama;
        $gelirEkle->tarih = date("d.m.Y H:i");
        $gelirEkle->time = time();
        $gelirEkle->save();
    }
}
