<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Middleware\ApiAi;
use App\Http\Conversations\HareketEkleConversation;
use App\Http\Conversations\BakiyeConversation;
use App\Http\Conversations\KarsilamaConversation;
use App\Http\Conversations\YardimConversation;

$botman = resolve('botman');

$apiAi = ApiAi::create('API_AI_TOKEN')->listenForAction();

$botman->middleware->received($apiAi);

$botman->hears('.*(/start|start).*', function (BotMan $bot) {
    $bot->startConversation(new KarsilamaConversation());
});

$botman->hears('.*(yardim|Yardim|Yardım|yardım).*', function (BotMan $bot) {
    $bot->startConversation(new YardimConversation());
});

$botman->hears('hareketler', function (BotMan $bot) {
    $bot->startConversation(new HareketEkleConversation());
})->middleware($apiAi);


$botman->hears('bakiye', function (BotMan $bot) {
    $bot->startConversation(new BakiyeConversation());
})->middleware($apiAi);

$botman->hears('selamlasma', function (BotMan $bot)
{
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $bot->types();
    $bot->reply($apiReply);
})->middleware($apiAi);

$botman->hears('vaziyet', function (BotMan $bot)
{
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $bot->types();
    $bot->reply($apiReply);
})->middleware($apiAi);

$botman->hears('tutum', function (BotMan $bot)
{
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $bot->types();
    $bot->reply($apiReply);
})->middleware($apiAi);

$botman->hears('tesekkur', function (BotMan $bot)
{
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $bot->types();
    $bot->reply($apiReply);
})->middleware($apiAi);

$botman->hears('sahip', function (BotMan $bot)
{
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $bot->types();
    $bot->reply($apiReply);
})->middleware($apiAi);

$botman->hears('yas', function (BotMan $bot)
{
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $bot->types();
    $bot->reply($apiReply);
})->middleware($apiAi);

$botman->hears('isim', function (BotMan $bot)
{
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $bot->types();
    $bot->reply($apiReply);
})->middleware($apiAi);

$botman->hears('elveda', function (BotMan $bot)
{
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $bot->types();
    $bot->reply($apiReply);
})->middleware($apiAi);

$botman->hears('Start conversation', BotManController::class.'@startConversation');
