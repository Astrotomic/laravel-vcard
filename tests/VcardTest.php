<?php

namespace Astrotomic\Vcard\Tests;

use Astrotomic\Vcard\Properties\Adr;
use Astrotomic\Vcard\Properties\Email;
use Astrotomic\Vcard\Properties\Gender;
use Astrotomic\Vcard\Properties\Kind;
use Astrotomic\Vcard\Properties\Tel;
use Astrotomic\Vcard\Vcard;
use Carbon\Carbon;

final class VcardTest extends TestCase
{
    /** @test */
    public function vcard_full(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->kind(Kind::INDIVIDUAL)
                ->gender(Gender::MALE)
                ->fullName('John Adam Smith')
                ->name('Smith', 'John', 'Adam')
                ->email('john.smith@mail.com')
                ->email('john.smith@company.com', [Email::WORK, Email::INTERNET])
                ->tel('+1234567890', [Tel::HOME, Tel::VOICE])
                ->tel('+0987654321', [Tel::WORK, Tel::VOICE])
                ->tel('+0123456789', [Tel::CELL, Tel::VOICE])
                ->url('https://johnsmith.com')
                ->url('https://company.com')
                ->bday(Carbon::parse('1990-06-24'))
                ->photo('data:image/jpeg;base64,'.base64_encode(file_get_contents(__DIR__.'/stubs/photo.jpg')))
                ->adr('', '', '1600 Pennsylvania Ave NW', 'Washington', 'DC', '20500-0003', 'USA')
                ->source('https://www.example.org')
        );
    }

    /** @test */
    public function vcard_with_fn(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
        );
    }

    /** @test */
    public function vcard_with_fn_n(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->name('Smith', 'John', 'Adam')
        );
    }

    /** @test */
    public function vcard_with_fn_email(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->email('john.smith@mail.com')
        );
    }

    /** @test */
    public function vcard_with_fn_email_workEmail(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->email('john.smith@mail.com')
                ->email('john.smith@company.com', [Email::WORK, Email::INTERNET])
        );
    }

    /** @test */
    public function vcard_with_fn_tel(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->tel('+1234567890')
        );
    }

    /** @test */
    public function vcard_with_fn_tel_workTel(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->tel('+1234567890')
                ->tel('+0987654321', [Tel::WORK, Tel::VOICE])
        );
    }

    /** @test */
    public function vcard_with_fn_url(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->url('https://johnsmith.com')
        );
    }

    /** @test */
    public function vcard_with_fn_urls(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->url('https://johnsmith.com')
                ->url('https://company.com')
        );
    }

    /** @test */
    public function vcard_with_fn_bday(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->bday(Carbon::parse('1990-06-24'))
        );
    }

    /** @test */
    public function vcard_with_fn_photo(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->photo('data:image/jpeg;base64,'.base64_encode(file_get_contents(__DIR__.'/stubs/photo.jpg')))
        );
    }

    /** @test */
    public function vcard_with_fn_org(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                 ->fullName('John Adam Smith')
                 ->org('Google', 'GMail Team', 'Spam Detection Squad')
        );
    }

    /** @test */
    public function vcard_with_fn_org_missing_unit(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                 ->fullName('John Adam Smith')
                 ->org('Google', null, 'Spam Detection Squad')
        );
    }

    /** @test */
    public function vcard_with_fn_role(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                 ->fullName('John Adam Smith')
                 ->role('Excecutive')
        );
    }

    /** @test */
    public function vcard_with_fn_title(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                 ->fullName('John Adam Smith')
                 ->title('V. P. Research and Development')
        );
    }

    /** @test */
    public function vcard_with_fn_member_mail(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                 ->fullName('John Adam Smith')
                 ->member('mailto:john.smith@company.com')
        );
    }

    /** @test */
    public function vcard_with_fn_member_uuid(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                 ->fullName('John Adam Smith')
                 ->member(null, 'urn:uuid:550e8400-e29b-11d4-a716-446655440000')
        );
    }

    /** @test */
    public function vcard_with_fn_member_uuid_and_mail(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                 ->fullName('John Adam Smith')
                 ->member('john.smith@company.com', '550e8400-e29b-11d4-a716-446655440000')
        );
    }

    /** @test */
    public function vcard_with_work_address(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->adr('', '', '1600 Pennsylvania Ave NW', 'Washington', 'DC', '20500-0003', 'USA', [Adr::WORK])
        );
    }

    /** @test */
    public function vcard_with_work_and_home_address(): void
    {
        $this->assertMatchesVcardSnapshot(
            Vcard::make()
                ->fullName('John Adam Smith')
                ->adr('', '', '1600 Pennsylvania Ave NW', 'Washington', 'DC', '20500-0003', 'USA',
                    [Adr::WORK, Adr::PREF])
                ->adr('', '', '1640 Riverside Drive', ' Hill Valley', 'CA', '', 'USA', [Adr::HOME])
        );
    }

    /** @test */
    public function vcard_to_response_header(): void
    {
        $response = Vcard::make()
            ->fullName('Jöhn Ädäm Smïth')->toResponse(null);

        $this->assertEquals($response->headers->get('content-length'), 129);
        $this->assertEquals($response->headers->get('Content-Disposition'), 'attachment; filename=john_adam_smith.vcf');
    }
}
