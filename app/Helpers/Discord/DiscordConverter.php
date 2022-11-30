<?php

namespace App\Helpers\Discord;

use Illuminate\Support\Arr;
use App\Helpers\Discord\Formating\Embed;
use App\Helpers\Discord\Formating\Message;
use Illuminate\Contracts\Config\Repository;

class DiscordConverter
{
    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function buildMesasges(array $record)
    {
        $mainMessage = Message::make();
        $message = $this->addMainEmbed($mainMessage, $record);
        // $message = $this->addContextEmbed($mainMessage, $record);

        return $message;
    }

    protected function addMainEmbed(Message $message, array $record)
    {
        $title = "{$record['channel']} - {$record['current_url']} - {$record['level_name']}";
        $description = $record['message'];
        $emoji = $this->getRecordEmoji($record);

        $message->embed(Embed::make()
            ->color($this->getRecordColor($record))
            ->title($emoji === null ? "$title" : "$emoji $title")
            ->description($emoji === null ? "`$description`" : ":black_small_square: `$description`"));

        return $message;
    }

    protected function addContextEmbed(Message $message, array $record)
    {
        $context = Arr::except($record['context'] ?? [], ['exception']);
        if (empty($context))
        {
            return;
        }

        $message->embed(Embed::make()
            ->color($this->getRecordColor($record))
            ->description("**Context**\n`" . json_encode($context, JSON_PRETTY_PRINT) . '`'));
            return $message;
    }

    protected function getRecordColor(array $record): int
    {
        $colors = $this->config->get('discord.colors', []);

        return $colors[$record['level_name']] ?? 0x666666;
    }

    protected function getRecordEmoji(array $record): ?string
    {
        $colors = $this->config->get('discord.emojis', []);

        return $colors[$record['level_name']] ?? null;
    }
}
