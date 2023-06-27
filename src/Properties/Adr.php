<?php

namespace Astrotomic\Vcard\Properties;

class Adr extends Property
{
    public const HOME = 'HOME';

    public const WORK = 'WORK';

    public const PREF = 'PREF';

    public function __construct(
        protected string $poBox,
        protected string $extendedAddress,
        protected string $streetAddress,
        protected string $locality,
        protected string $region,
        protected string $postalCode,
        protected string $countryName,
        protected array $types
    ) {
    }

    public function __toString(): string
    {
        $types = implode(';', array_map(
            fn (string $type): string => "TYPE={$type}",
            $this->types
        ));

        $parameters = implode(';', [
            $this->poBox,
            $this->extendedAddress,
            $this->streetAddress,
            $this->locality,
            $this->region,
            $this->postalCode,
            $this->countryName,
        ]);

        return "ADR;{$types}:{$parameters}";
    }
}
