<?php

namespace Astrotomic\Vcard\Properties;

class Email extends Property
{
    public const INTERNET = 'INTERNET';
    public const WORK = 'WORK';

    protected string $email;

    /** @var string[] */
    protected array $types;

    public function __construct(string $email, array $types)
    {
        $this->email = $email;
        $this->types = $types;
    }

    public function __toString(): string
    {
        $types = implode(';', array_map(
            fn(string $type): string => "TYPE={$type}",
            $this->types
        ));

        return "EMAIL;{$types}:{$this->email}";
    }
}
