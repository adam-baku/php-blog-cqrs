<?php
declare(strict_types=1);

namespace App\Domain;

use App\Common\EntityAbstract;
use App\Common\ImageAttachment;
use App\Domain\Exception\ImageAlreadyAttachedException;

class Post extends EntityAbstract
{
    private string $title;
    private string $content;
    private ImageAttachment $image;

    public function __construct(string $guid, string $title, string $content)
    {
        $this->guid = $guid;
        $this->title = $title;
        $this->content = $content;
    }

    public function attachImage(ImageAttachment $image): void
    {
        if (!empty($this->image)) {
            throw ImageAlreadyAttachedException::toPost($this);
        }

        $this->image = $image;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function image(): ImageAttachment
    {
        return $this->image;
    }
}
