<?php

namespace App\Http\Controllers;

use App\Bakiye;


class GiderBakiyesiController extends Controller
{

    public static function update($user_id, $bakiye_miktar, $bakiye_birim)
    {

        $hesap = Bakiye::where('user_id', $user_id)->first();
        $bot = resolve('botman');

        if ($hesap) {
            if ($hesap->bakiye >= $bakiye_miktar) {
                $hesap->bakiye = number_format($hesap->bakiye - $bakiye_miktar, 2, '.', ',');
                $hesap->save();

                //Yanıtlandır
                $bot->reply('Tamam ' . $bakiye_miktar . " " . $bakiye_birim . " eksilttim :( ");
                //Buralara daha sonra random metin cevapları getirebiliriz.

            } else {
                $bot->reply('Üzgünüm ama harcadığın paranın bakiyenden büyük olması imkansız.');
                $bot->reply('Bu yüzden şimdi çıkarma yapamadım lütfen gireceğin tutar ' . $hesap->bakiye . ' TL ve onun altında olsun. 👍🏼');
            }
        }
    }
}
