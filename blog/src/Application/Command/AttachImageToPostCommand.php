<?php
declare(strict_types=1);

namespace App\Application\Command;

class AttachImageToPostCommand
{
    public function __construct(public string $postGuid, public string $imagePath) {}
}
