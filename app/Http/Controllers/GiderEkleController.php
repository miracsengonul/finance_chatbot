<?php

namespace App\Http\Controllers;

use App\Bakiye;
use App\GiderEkle;

class GiderEkleController extends Controller
{
    public static function store($user_id, $miktar, $para_birimi, $aciklama)
    {
        $hesap = Bakiye::where('user_id', $user_id)->first();
        $bot = resolve('botman');

        if ($hesap) {
            $gelirEkle = new GiderEkle();
            $gelirEkle->user_id = $user_id;
            $gelirEkle->miktar = $miktar;
            $gelirEkle->para_birimi = $para_birimi;
            $gelirEkle->aciklama = $aciklama;
            $gelirEkle->tarih = date("d.m.Y H:i");
            $gelirEkle->time = time();
            $gelirEkle->save();
        } else {
            $bot->reply("Para çıkarmam için öncelikle hesabınızda para olması gerekiyor.");
        }
    }
}
