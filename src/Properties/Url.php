<?php

namespace Astrotomic\Vcard\Properties;

class Url extends Property
{
    public function __construct(protected string $url) {}

    public function __toString(): string
    {
        return "URL:{$this->url}";
    }
}
