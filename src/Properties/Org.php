<?php

namespace Astrotomic\Vcard\Properties;

class Org extends Property
{
    public function __construct(
        protected string $company, protected ?string $unit, protected ?string $team
    )
    {
    }

    public function __toString(): string
    {
        return 'ORG:' . implode(';', [$this->company, $this->unit, $this->team]);
    }
}
