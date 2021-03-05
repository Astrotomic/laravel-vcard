<?php

namespace Astrotomic\Vcard\Properties;

use Exception;
use Ramsey\Uuid\Uuid;

class Member extends Property
{
    public const UUID = 'Uuid';
    public const MAIL = 'Mail';

    public function __construct(protected string $member, protected string $type)
    {
        if(!in_array($this->type, [self::MAIL, self::UUID])) {
            throw new Exception('Invalid type for member property.');
        }

        $method = "validate{$type}";
        if(! $this->$method()) {
            throw new Exception(
                'Invalid member property. Either a valid uuid or a "mailto:<email>" are accepted.'
            );
        }
    }

    protected function validateUuid(): bool
    {
        $member = $this->member;

        // Special handling if a uuid is part of a urn
        // f. ex. urn:uuid:550e8400-e29b-11d4-a716-446655440000
        if(strpos($this->type, ':') === true) {
            $member = explode(':', $member);

            foreach ($member as $part) {
                if(Uuid::isValid($part) === true) {
                    return true;
                }
            }

            return false;
        }

        return Uuid::isValid($member);
    }

    protected function validateMail(): bool
    {
        $parts = explode(':', $this->member);

        // TODO: Add further check if email address is valid
        // $parts[1] === ...
        return $parts[0] === 'mailto';
    }

    public function __toString(): string
    {
        return "MEMBER:{$this->member}";
    }
}
