<?php

namespace Astrotomic\Vcard\Properties;

class Photo extends Property
{
    public function __construct(protected string $photo)
    {
    }

    public function __toString(): string
    {
        return "PHOTO:{$this->photo}";
    }
}
