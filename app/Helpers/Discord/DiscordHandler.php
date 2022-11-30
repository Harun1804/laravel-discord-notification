<?php

namespace App\Helpers\Discord;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\URL;
use Monolog\Handler\AbstractProcessingHandler;

class DiscordHandler extends AbstractProcessingHandler
{
    private $recordToMessage;
    private $url;
    private $currentUrl;

    public function __construct(Repository $config, array $channelConfig)
    {
        $this->recordToMessage = new DiscordConverter($config);
        $this->url = $channelConfig['url'];
        $this->currentUrl = ['current_url' => URL::current()];
    }

    public function write(array $records):void
    {
        $records = array_merge($records, $this->currentUrl);
        $message = $this->recordToMessage->buildMesasges($records);
        $this->send($message);
    }

    public function send($message)
    {
        return Http::post($this->url,$message);
    }
}
