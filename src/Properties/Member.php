<?php

namespace Astrotomic\Vcard\Properties;

use Illuminate\Support\Str;
use InvalidArgumentException;

class Member extends Property
{
    public function __construct(protected ?string $email, protected ?string $uuid)
    {
    }

    public function __toString(): string
    {
        if($this->uuid) {
            $member = Str::start($this->uuid, 'urn:uuid:');
        } elseif($this->email) {
            $member = Str::start($this->email, 'mailto:');
        } else {
            throw new InvalidArgumentException('You have to pass at least one member identifier.');
        }

        return "MEMBER:{$member}";
    }
}
