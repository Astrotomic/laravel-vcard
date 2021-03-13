<?php

namespace Astrotomic\Vcard\Properties;

class Role extends Property
{
    public function __construct(protected string $role)
    {
    }

    public function __toString(): string
    {
        return "ROLE:{$this->role}";
    }
}
