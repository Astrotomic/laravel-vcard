<?php

namespace Astrotomic\Vcard\Properties;

class Org extends Property
{
    public function __construct(protected string $org)
    {
    }

    public function __toString(): string
    {
        return "ORG:{$this->org}";
    }
}
