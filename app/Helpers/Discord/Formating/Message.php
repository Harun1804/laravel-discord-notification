<?php

namespace App\Helpers\Discord\Formating;

use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;

class Message implements Arrayable
{
    public $content;
    public $username;
    public $avatarUrl;
    public $tts = false;
    public $file;
    public $embeds;

    public static function make(?string $content = null): Message
    {
        return new self($content);
    }

    protected function __construct(?string $content = null)
    {
        if ($content !== null)
        {
            $this->content($content);
        }
    }

    public function content(string $content): Message
    {
        $this->content = Str::limit($content, 2000 - 3);
        return $this;
    }

    public function from(string $username, ?string $avatarUrl = null): Message
    {
        $this->username = $username;
        if ($avatarUrl !== null)
        {
            $this->avatarUrl = $avatarUrl;
        }
        return $this;
    }

    public function tts(bool $enabled = true): Message
    {
        $this->tts = $enabled;
        return $this;
    }

    public function file(string $contents, string $filename): Message
    {
        $this->file = [
            'name'     => 'file',
            'contents' => $contents,
            'filename' => $filename,
        ];
        return $this;
    }

    public function embed(Embed $embed): Message
    {
        $this->embeds[] = $embed;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter(
        [
            'content'    => $this->content,
            'username'   => $this->username,
            'avatar_url' => $this->avatarUrl,
            'tts'        => $this->tts ? 'true' : 'false',
            'file'       => $this->file,
            'embeds'     => $this->serializeEmbeds(),
        ],
            static function ($value) {
                return $value !== null && $value !== [];
            });
    }

    protected function serializeEmbeds(): array
    {
        return array_map(static function (Arrayable $embed) {
            return $embed->toArray();
        }, $this->embeds ?? []);
    }
}
