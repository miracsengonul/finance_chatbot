<?php

namespace App\Http\Conversations;

use App\Http\Controllers\BakiyeController;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BakiyeConversation extends Conversation
{
    protected $user_id;

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->Sorgula();
    }

    public function Sorgula()
    {
        $user = $this->bot->getUser();
        $this->user_id = $user->getId();
        $sorgula = BakiyeController::show($this->user_id);
    }

}
