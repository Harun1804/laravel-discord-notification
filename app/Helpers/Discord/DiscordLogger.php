<?php

namespace App\Helpers\Discord;

use Monolog\Logger;
use InvalidArgumentException;
use Illuminate\Config\Repository;

class DiscordLogger
{
    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function __invoke(array $config)
    {
        if(empty($config['url'])){
            throw new InvalidArgumentException('You must set the `url` key in your discord channel configuration');
        }

        return new Logger($this->config->get('app.name'), [$this->newDiscordLogHandler($config)]);
    }

    protected function newDiscordLogHandler(array $config): DiscordHandler
    {
        return new DiscordHandler($this->config, $config);
    }
}
