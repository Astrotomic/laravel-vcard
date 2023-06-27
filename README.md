# Laravel vCard

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/laravel-vcard.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/laravel-vcard)
[![MIT License](https://img.shields.io/github/license/Astrotomic/laravel-vcard.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/laravel-vcard/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://plant.treeware.earth/Astrotomic/laravel-vcard)
[![Larabelles](https://img.shields.io/badge/Larabelles-%F0%9F%A6%84-lightpink?style=for-the-badge)](https://www.larabelles.com/)

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/Astrotomic/laravel-vcard/run-tests?style=flat-square&logoColor=white&logo=github&label=Tests)](https://github.com/Astrotomic/laravel-vcard/actions?query=workflow%3Arun-tests)
[![StyleCI](https://styleci.io/repos/341030229/shield)](https://styleci.io/repos/341030229)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/laravel-vcard.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/laravel-vcard)

A fluent builder class for vCard files.

## Installation

You can install the package via composer:

```bash
composer require astrotomic/laravel-vcard
```

## Usage

```php
use Astrotomic\Vcard\Properties\Email;
use Astrotomic\Vcard\Properties\Gender;
use Astrotomic\Vcard\Properties\Kind;
use Astrotomic\Vcard\Properties\Tel;
use Astrotomic\Vcard\Vcard;
use Carbon\Carbon;

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
    ->adr('','','1600 Pennsylvania Ave NW', 'Washington', 'DC', '20500-0003', 'USA')
    ->photo('data:image/jpeg;base64,'.base64_encode(file_get_contents(__DIR__.'/stubs/photo.jpg')))
    ->title('V. P. Research and Development')
    ->role('Excecutive')
    ->org('Google', 'GMail Team', 'Spam Detection Squad')
    ->member('john.smith@company.com', '550e8400-e29b-11d4-a716-446655440000')
;
```

```vcard
BEGIN:VCARD
VERSION:4.0
FN;CHARSET=UTF-8:John Adam Smith
N;CHARSET=UTF-8:Smith;John;Adam;;
KIND:individual
GENDER:M
EMAIL;TYPE=INTERNET:john.smith@mail.com
EMAIL;TYPE=WORK;TYPE=INTERNET:john.smith@company.com
TEL;TYPE=HOME;TYPE=VOICE:+1234567890
TEL;TYPE=WORK;TYPE=VOICE:+0987654321
TEL;TYPE=CELL;TYPE=VOICE:+0123456789
URL:https://johnsmith.com
URL:https://company.com
BDAY:1990-06-24
ADR;TYPE=WORK:;;1600 Pennsylvania Ave NW;Washington;DC;20500-0003;USA
PHOTO;data:image/jpeg;base64,...
TITLE:V. P. Research and Development
ROLE:Excecutive
ORG:Google;GMail Team;Spam Detection Squad
MEMBER:urn:uuid:550e8400-e29b-11d4-a716-446655440000
REV:2021-02-25T10:30:45.000000Z
PRODID:-//Astrotomic vCard
END:VCARD
```
