<?php

namespace Astrotomic\Vcard\Properties;

class Url extends Property
{
    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function __toString(): string
    {
        return "URL:{$this->url}";
    }
}
