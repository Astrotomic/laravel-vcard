<?php

namespace Astrotomic\Vcard\Properties;

class Tel extends Property
{
    public const VOICE = 'VOICE';
    public const WORK = 'WORK';
    public const HOME = 'HOME';
    public const CELL = 'CELL';

    protected string $number;

    /** @var string[] */
    protected array $types;

    public function __construct(string $number, array $types)
    {
        $this->number = $number;
        $this->types = $types;
    }

    public function __toString(): string
    {
        $types = implode(';', array_map(
            fn(string $type): string => "TYPE={$type}",
            $this->types
        ));

        return "TEL;{$types}:{$this->number}";
    }
}
