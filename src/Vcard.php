<?php

namespace Astrotomic\Vcard;

use Astrotomic\Vcard\Properties\Bday;
use Astrotomic\Vcard\Properties\Email;
use Astrotomic\Vcard\Properties\Gender;
use Astrotomic\Vcard\Properties\Kind;
use Astrotomic\Vcard\Properties\Photo;
use Astrotomic\Vcard\Properties\Tel;
use Astrotomic\Vcard\Properties\Url;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Stringable;
use Symfony\Component\HttpFoundation\HeaderUtils;

class Vcard implements Responsable, Stringable
{
    protected ?string $fullName = null;
    protected ?string $namePrefix = null;
    protected ?string $firstName = null;
    protected ?string $middleName = null;
    protected ?string $lastName = null;
    protected ?string $nameSuffix = null;

    protected array $properties = [];

    public static function make(): self
    {
        return new static();
    }

    public function fullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function name(
        ?string $lastName = null,
        ?string $firstName = null,
        ?string $middleName = null,
        ?string $prefix = null,
        ?string $suffix = null
    ): self
    {
        $this->namePrefix = $prefix;
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->nameSuffix = $suffix;

        return $this;
    }

    public function email(string $email, array $types = [Email::INTERNET]): self
    {
        $this->properties[] = new Email($email, $types);

        return $this;
    }

    public function tel(string $number, array $types = [Tel::VOICE]): self
    {
        $this->properties[] = new Tel($number, $types);

        return $this;
    }

    public function url(string $url): self
    {
        $this->properties[] = new Url($url);

        return $this;
    }

    public function photo(string $photo): self
    {
        $this->properties[] = new Photo($photo);

        return $this;
    }

    public function bday(DateTimeInterface $bday): self
    {
        $this->properties[] = new Bday($bday);

        return $this;
    }

    public function kind(string $kind): self
    {
        $this->properties[] = new Kind($kind);

        return $this;
    }

    public function gender(string $gender): self
    {
        $this->properties[] = new Gender($gender);

        return $this;
    }

    public function __toString(): string
    {
        return collect([
            'BEGIN:VCARD',
            'VERSION:4.0',
            "FN;CHARSET=UTF-8:{$this->getFullName()}",
            $this->hasNameParts() ? "N;CHARSET=UTF-8:{$this->lastName};{$this->firstName};{$this->middleName};{$this->namePrefix};{$this->nameSuffix}" : null,
            array_map('strval', $this->properties),
            sprintf('REV:%s', Carbon::now()->toISOString()),
            'PRODID:-//Astrotomic vCard',
            'END:VCARD',
        ])->flatten()->filter()->implode(PHP_EOL);
    }

    public function toResponse($request)
    {
        $content = strval($this);

        $filename = Str::of($this->name)->slug('_')->append('.vcf');

        return new Response($content, 200, [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Type' => 'text/vcard',
            'Content-Length' => Str::length($content),
            'Content-Disposition' => HeaderUtils::makeDisposition(
                HeaderUtils::DISPOSITION_ATTACHMENT,
                $filename,
                $filename->ascii()->replace('%', '')
            ),
        ]);
    }

    protected function getFullName(): string
    {
        return $this->fullName ?? collect([
            $this->namePrefix,
            $this->firstName,
            $this->middleName,
            $this->lastName,
            $this->nameSuffix,
        ])->filter()->implode(' ');
    }

    protected function hasNameParts(): bool
    {
        return !empty(array_filter([
            $this->namePrefix,
            $this->firstName,
            $this->middleName,
            $this->lastName,
            $this->nameSuffix,
        ]));
    }
}
