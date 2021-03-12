<?php

namespace Astrotomic\Vcard\Properties;

class Member extends Property
{
    public function __construct(protected ?string $email, protected ?string $uuid)
    {
    }

    public function __toString(): string
    {
        return 'MEMBER:' . ($this->uuid ?: $this->email);
    }
}
