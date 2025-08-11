<?php

namespace Astrotomic\Vcard\Properties;

class Org extends Property
{
    public function __construct(
        protected ?string $company = null,
        protected ?string $unit = null,
        protected ?string $team = null
    ) {}

    public function __toString(): string
    {
        return "ORG:{$this->company};{$this->unit};{$this->team}";
    }
}
