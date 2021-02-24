<?php

namespace Astrotomic\Vcard\Properties;

use Illuminate\Support\Str;
use InvalidArgumentException;

class Photo extends Property
{
    protected string $photo;

    public function __construct(string $photo)
    {
        if (! Str::startsWith($photo, 'data:image/jpeg;base64,')) {
            throw new InvalidArgumentException('Photo property has to be a jpeg base64 data-uri.');
        }

        $this->photo = $photo;
    }

    public function __toString(): string
    {
        return "PHOTO:{$this->photo}";
    }
}
