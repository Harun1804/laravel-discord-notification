<?php

namespace App\Helpers\Discord\Formating;

use Illuminate\Contracts\Support\Arrayable;

class EmbedField implements Arrayable
{
    public $name;
    public $value;
    public $inline;

    public static function make(string $name = '', string $value = '', bool $inline = false)
    {
        return new self($name, $value, $inline);
    }

    protected function __construct(string $name, string $value, bool $inline = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->inline = $inline;
    }

    public function name(string $name): EmbedField
    {
        $this->name = $name;
        return $this;
    }

    public function value(string $value): EmbedField
    {
        $this->value = $value;
        return $this;
    }

    public function inline(string $inline): EmbedField
    {
        $this->inline = $inline;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'name'      => $this->name,
            'value'     => $this->value,
            'inline'    => $this->inline,
        ];
    }
}
