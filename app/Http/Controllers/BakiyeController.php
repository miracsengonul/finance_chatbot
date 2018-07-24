<?php

namespace App\Http\Controllers;

use App\Bakiye;


class BakiyeController extends Controller
{
    public static function show($user_id)
    {
        $bot = resolve('botman');

        $bakiye = Bakiye::where('user_id', $user_id)->first();
        if ($bakiye) {
            $bakiye = $bakiye->bakiye;
            $bot->reply("Hesabınızda şu an " . $bakiye . " TL bulunmaktadır.");
        } else {
            $bot->reply("Hesabınız olmadığı için herhangi bir bakiye gösteremiyorum :/");
        }

    }
}
