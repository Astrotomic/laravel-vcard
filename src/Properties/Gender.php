<?php

namespace Astrotomic\Vcard\Properties;

class Gender extends Property
{
    public const FEMALE = 'F';
    public const MALE = 'M';

    protected string $gender;

    public function __construct(string $gender)
    {
        $this->gender = $gender;
    }

    public function __toString(): string
    {
        return "GENDER:{$this->gender}";
    }
}
