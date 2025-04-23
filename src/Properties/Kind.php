<?php

namespace Astrotomic\Vcard\Properties;

class Kind extends Property
{
    public const INDIVIDUAL = 'individual';

    public const ORGANIZATION = 'organization';

    public const GROUP = 'group';

    public function __construct(protected string $kind) {}

    public function __toString(): string
    {
        return "KIND:{$this->kind}";
    }
}
