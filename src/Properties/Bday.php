<?php

namespace Astrotomic\Vcard\Properties;

use DateTimeInterface;

class Bday extends Property
{
    public function __construct(protected DateTimeInterface $bday) {}

    public function __toString(): string
    {
        return "BDAY:{$this->bday->format('Y-m-d')}";
    }
}
