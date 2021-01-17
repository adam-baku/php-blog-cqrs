<?php
declare(strict_types=1);

namespace App\Domain\Exception;

use RuntimeException;

class PostNotFoundException extends RuntimeException
{
    public static function forGuid(string $guid): self
    {
        return new self("Post #{$guid} not found.");
    }
}
