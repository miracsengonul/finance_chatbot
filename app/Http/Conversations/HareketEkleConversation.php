<?php

namespace App\Http\Conversations;

use App\Http\Controllers\GelirBakiyesiController;
use App\Http\Controllers\GelirEkleController;
use App\Http\Controllers\GiderBakiyesiController;
use App\Http\Controllers\GiderEkleController;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class HareketEkleConversation extends Conversation
{

    /** @var integer */
    protected $miktar;

    /** @var string */
    protected $para_birimi;

    /**  @var string */
    protected $durum;

    /** @var string */
    protected $taban_degeri;

    /** @var integer */
    protected $user_id;

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->Kaydet();
    }


    public function Kaydet()
    {
        $user = $this->bot->getUser();

        $this->user_id = $user->getId();

        $extras = $this->bot->getMessage()->getExtras();

        $apiParameters = $extras['apiParameters'];

        $parametersData = json_decode(json_encode($apiParameters), true);

        $apiqueryText = json_decode(json_encode($extras['apiqueryText']), true);

        if ((preg_match('/[^0-9]/', $apiqueryText)) and strstr($apiqueryText, ',') and !strstr($apiqueryText, '.')) {
            $this->miktar = str_replace(',', '.', $apiqueryText);

            $this->miktar = preg_match('/(\d+[.]?\d*)/', $this->miktar, $cikti);

            $this->miktar = $cikti[0];

            $parametersData['number'] = $this->miktar;
        }

        if (!empty($parametersData['number'])) {
            $this->miktar = is_array($parametersData['number']) ? $parametersData['number'][0] : $parametersData['number'];
        }

        $this->durum = $parametersData['durum'];

        $this->para_birimi = $parametersData['para_birimi'] ? $parametersData['para_birimi'] : 'lira';

        $this->taban_degeri = $parametersData['taban_degeri'];

        if ($this->miktar && $this->taban_degeri) {
            if ($this->taban_degeri == 'bin') {
                $this->miktar = $this->miktar . '000';
            } elseif ($this->taban_degeri == "yüz") {
                $this->miktar = $this->miktar . '00';
            }
        }

        if ($this->durum == 'gelir') {

            $this->ask('Bu gelirinizi bir kelime ile açıklar mısınız lütfen 👀', function (Answer $response) {

                $aciklama = $response->getText();

                if (!empty($aciklama)) {
                    $this->miktar = number_format($this->miktar, 2, '.', ',');

                    $gelir_kaydet = GelirEkleController::store($this->user_id, $this->miktar, $this->para_birimi, $aciklama);

                    $bakiye_kaydet = GelirBakiyesiController::update($this->user_id, $this->miktar);

                    $this->say($this->miktar . " " . $this->para_birimi . " gelen hesabınıza aktardım. Güle güle harcayın. ✋🏼");
                }

            });

        } elseif ($this->durum == 'gider') {

            $this->ask($this->miktar . ' ' . $this->para_birimi . ' nereye harcadın baba ?', function (Answer $response) {

                $aciklama = $response->getText();

                if (!empty($aciklama)) {
                    $this->miktar = number_format($this->miktar, 2, '.', ',');

                    $gelir_kaydet = GiderEkleController::store($this->user_id, $this->miktar, $this->para_birimi, $aciklama);

                    $bakiye_kaydet = GiderBakiyesiController::update($this->user_id, $this->miktar, $this->para_birimi);
                }

            });

        }


    }

}
