<?php
declare(strict_types=1);

namespace App\Common;

use App\Common\Exception\ExtensionNotAvailableException;

class Attachment
{
    public const AVAILABLE_EXTENSIONS = [];

    protected string $path;

    public function __construct(string $path)
    {
        $this->assertExtension($path);
        $this->path = $path;
    }

    public function path(): string
    {
        return $this->path;
    }

    protected function assertExtension(string $path): void
    {
        if (empty(static::AVAILABLE_EXTENSIONS)) {
            return;
        }

        $regex = \implode("$|\.", static::AVAILABLE_EXTENSIONS);

        if (\preg_match_all("/\.{$regex}$/", $path) === 0) {
            throw ExtensionNotAvailableException::forAttachment($this);
        }
    }
}
