<?php

namespace Astrotomic\Vcard\Properties;

class Gender extends Property
{
    public const FEMALE = 'F';
    public const MALE = 'M';
    public const OTHER = 'O';
    public const NONE = 'N';
    public const UNKNOWN = 'U';

    public function __construct(protected string $gender)
    {
    }

    public function __toString(): string
    {
        return "GENDER:{$this->gender}";
    }
}
