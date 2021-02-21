<?php

namespace Astrotomic\Vcard;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Stringable;
use Symfony\Component\HttpFoundation\HeaderUtils;

class Vcard implements Stringable, Responsable
{
    protected string $name;
    protected ?string $email = null;
    protected ?string $phone = null;

    public static function make(string $name): self
    {
        return new static($name);
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function email(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function phone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
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

    public function __toString(): string
    {
        return collect([
            'BEGIN:VCARD',
            'VERSION:4.0',
            sprintf('FN:%s', $this->name),
            $this->email ? sprintf('EMAIL:%s', $this->email) : null,
            $this->phone ? sprintf('TEL;TYPE=VOICE:%s', $this->phone) : null,
            'END:VCARD',
        ])->filter()->implode(PHP_EOL);
    }
}
