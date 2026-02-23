<?php

namespace Astrotomic\Vcard\Properties;

class SocialProfile extends Property
{
    public const FACEBOOK = 'facebook';

    public const TWITTER = 'twitter';

    public const LINKEDIN = 'linkedin';

    public const INSTAGRAM = 'instagram';

    public const YOUTUBE = 'youtube';

    public const TIKTOK = 'tiktok';

    public const GITHUB = 'github';

    public function __construct(protected string $type, protected string $url) {}

    public function __toString(): string
    {
        return "X-SOCIALPROFILE;type={$this->type}:{$this->url}";
    }
}
