<?php

namespace App\Helpers;

use App\Models\ShortUrl;

class SlugGenerator
{
    public const  MAX_CHARS  = 16;
    private const SLUG_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';

    private int $length;
    private int $attempts = 0;
    private int $maxAttempts;

    public function __construct(int $desiredLength = 3)
    {
        $this->setLength($desiredLength);
    }

    private function setLength(int $length): void
    {
        $this->length = $length;
        $this->attempts = 0;

        $this->maxAttempts = strlen(self::SLUG_CHARS) ** $length;
    }

    public function generate(): string
    {
        $slug = '';
        $availableChars = strlen(self::SLUG_CHARS);

        // building a slug randomly
        for ($i = 0; $i < $this->length; $i++) {
            $randIndex = random_int(0, $availableChars - 1);
            $slug .= self::SLUG_CHARS[$randIndex];
        }

        if ($this->isAvailable($slug)) {
            $this->attempts = 0;
            return $slug;
        }

        $this->attempts++;

        // if all combinations of this length failed, increasing length
        if ($this->attempts >= $this->maxAttempts) {
            $this->setLength($this->length + 1);
        }

        return $this->generate();
    }

    public function isAvailable(string $slug): bool
    {
        return !ShortUrl::query()->where('slug', $slug)->exists();
    }
}