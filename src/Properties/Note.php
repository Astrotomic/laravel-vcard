<?php

namespace Astrotomic\Vcard\Properties;

class Note extends Property
{
    public function __construct(protected string $note) {}

    public function __toString(): string
    {
        return 'NOTE:'.preg_replace('/[\r\n]+/', '\n', $this->note);
    }
}
