<?php

namespace Astrotomic\Vcard\Properties;

use DateTimeInterface;

class Bday extends Property
{
    protected DateTimeInterface $bday;

    public function __construct(DateTimeInterface $bday)
    {
        $this->bday = $bday;
    }

    public function __toString(): string
    {
        return "BDAY:{$this->bday->format('Y-m-d')}";
    }
}
