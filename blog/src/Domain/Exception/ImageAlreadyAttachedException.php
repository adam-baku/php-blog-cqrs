<?php
declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\Post;
use RuntimeException;

class ImageAlreadyAttachedException extends RuntimeException
{
    public static function toPost(Post $post): self
    {
        return new self("Image already attached to post #{$post->guid()}");
    }
}
