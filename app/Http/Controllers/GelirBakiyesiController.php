<?php

namespace App\Http\Controllers;

use App\Bakiye;

class GelirBakiyesiController extends Controller
{

    public static function update($user_id, $bakiye_miktar)
    {

        $hesap = Bakiye::where('user_id', $user_id)->first();

        if ($hesap) {
            $hesap->user_id = $user_id;
            $hesap->bakiye = number_format($hesap->bakiye + $bakiye_miktar, 2, '.', ',');
            $hesap->save();
        } else {
            $bakiye = new Bakiye();
            $bakiye->user_id = $user_id;
            $bakiye->bakiye = number_format($bakiye_miktar, 2, '.', ',');
            $bakiye->save();
        }
    }
}
