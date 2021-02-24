<?php

namespace Astrotomic\Vcard\Tests\Utils;

use Spatie\Snapshots\Drivers\TextDriver;

class VcardDriver extends TextDriver
{
    public function extension(): string
    {
        return 'vcf';
    }
}
