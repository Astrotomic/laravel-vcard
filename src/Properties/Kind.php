<?php

namespace Astrotomic\Vcard\Properties;

class Kind extends Property
{
    public const INDIVIDUAL = 'individual';
    public const ORGANIZATION = 'organization';
    public const GROUP = 'group';

    protected string $kind;

    public function __construct(string $kind)
    {
        $this->kind = $kind;
    }

    public function __toString(): string
    {
        return "KIND:{$this->kind}";
    }
}
