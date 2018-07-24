<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;


class KarsilamaConversation extends Conversation
{

    public function run()
    {
        $this->Karsilama();
    }


    public function Karsilama()
    {
        $user = $this->bot->getUser();
        $user_name = $user->getFirstName();
        $this->say("Merhaba, " . $user_name . "️. Ben sana gelir ve gider konusunda bütçe takibi yapman için yardımcı olacak bir asistanım. 😍");
        $this->bot->typesAndWaits(2);
        $this->say("Beni nasıl kullanacağın konusunda 'yardım' yazarsan sana yardımcı olabilirim. 😜");
    }

}
