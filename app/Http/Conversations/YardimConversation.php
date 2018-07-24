<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;

class YardimConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->Yardim();
    }

    public function Yardim()
    {

        $question = Question::create("Şimdi ben size şöyle yardımcı olayım.")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Gelir sağladığımda bu parayı nasıl ekleyebilirim ?')->value('gelir'),
                Button::create('Harcama yaptığımda nasıl kayıt edecem ?')->value('gider'),
                Button::create('Bakiyemi nasıl sorgulayabilirim ?')->value('bakiye'),
            ]);

        return $this->ask($question, function (Answer $answer) {

            if ($answer->getValue() === 'gelir')

                $this->say("Bana '50 lira ekle' veya '15 TL yükle' gibi ifadelerde bulunursan, gelir olarak bakiyene girdiğin para tutarını aktarabilirim.");

            elseif ($answer->getValue() == 'gider')

                $this->say("50 TL çıkar veya 15 lira harcadım gibi ifadelerde bulunursan hesabından belirttiğin miktarı çıkarırım.");

            elseif ($answer->getValue() == 'bakiye')

                $this->say("Ne kadar param kaldı ? Kaç liram var ? gibi soru sorarsan anlık olarak bakiyeni söylerim sana.");


        });


    }
}
