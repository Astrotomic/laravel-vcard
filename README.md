# Laravel vCard

## Usage

```php
Vcard::make()
    ->fullName('John Adam Smith')
    ->name('Smith', 'John', 'Adam')
    ->email('john.smith@mail.com')
    ->email('john.smith@company.com', [Email::WORK, Email::INTERNET])
    ->tel('+1234567890', [Tel::HOME, Tel::VOICE])
    ->tel('+0987654321', [Tel::WORK, Tel::VOICE])
    ->tel('+0123456789', [Tel::CELL, Tel::VOICE])
    ->url('https://johnsmith.com')
    ->url('https://company.com')
    ->bday(Carbon::parse('1990-06-24'));
```

```vcard
BEGIN:VCARD
VERSION:4.0
FN;CHARSET=UTF-8:John Adam Smith
N;CHARSET=UTF-8:Smith;John;Adam;;
EMAIL;TYPE=INTERNET:john.smith@mail.com
EMAIL;TYPE=WORK;TYPE=INTERNET:john.smith@company.com
TEL;TYPE=HOME;TYPE=VOICE:+1234567890
TEL;TYPE=WORK;TYPE=VOICE:+0987654321
TEL;TYPE=CELL;TYPE=VOICE:+0123456789
URL:https://johnsmith.com
URL:https://company.com
BDAY:1990-06-24
REV:2021-02-25T10:30:45.000000Z
END:VCARD
```
