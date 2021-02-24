<?php

namespace Astrotomic\Vcard\Tests;

use Astrotomic\Vcard\Tests\Utils\VcardDriver;
use Astrotomic\Vcard\Vcard;
use Carbon\Carbon;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Spatie\Snapshots\MatchesSnapshots;

abstract class TestCase extends OrchestraTestCase
{
    use MatchesSnapshots;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::parse('2021-02-25 10:30:45'));
    }

    public function assertMatchesVcardSnapshot(Vcard $actual): void
    {
        $vcard = strval($actual);

        $this->assertStringStartsWith('BEGIN:VCARD', $vcard);
        $this->assertStringEndsWith('END:VCARD', $vcard);

        $this->assertMatchesSnapshot($actual, new VcardDriver());
    }
}
