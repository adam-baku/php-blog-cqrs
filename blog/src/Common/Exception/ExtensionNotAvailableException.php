<?php
declare(strict_types=1);

namespace App\Common\Exception;

use App\Common\Attachment;
use RuntimeException;

class ExtensionNotAvailableException extends RuntimeException
{
    public static function forAttachment(Attachment $attachment): self
    {
        $availableExtensions = \implode(",", $attachment::AVAILABLE_EXTENSIONS);

        return new self("Extension is not available for {$attachment->path()}. Available extensions are {$availableExtensions}");
    }
}
