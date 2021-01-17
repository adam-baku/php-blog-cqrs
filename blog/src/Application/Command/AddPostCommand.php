<?php
declare(strict_types=1);

namespace App\Application\Command;

class AddPostCommand
{
    public function __construct(public string $guid, public string $title, public string $content) { }
}
