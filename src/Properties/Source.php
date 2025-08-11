<?php

namespace Astrotomic\Vcard\Properties;

class Source extends Property
{
    public function __construct(protected string $source) {}

    public function __toString(): string
    {
        return "SOURCE:{$this->source}";
    }
}
