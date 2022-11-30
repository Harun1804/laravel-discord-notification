<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendNotifDiscord extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Http::post(config('notification.discord.hook_url'),[
            'content'   => "Aku Ganteng",
            'embeds'    => [
                [
                    'title' => 'An Awesome Boy',
                    'description' => 'Discord webhooks are great',
                    'color' => '7506394'
                ]
            ]
        ]);
    }
}
