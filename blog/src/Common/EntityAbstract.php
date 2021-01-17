<?php
declare(strict_types=1);

namespace App\Common;

abstract class EntityAbstract
{
    protected string $guid;

    public function guid(): string
    {
        return $this->guid;
    }
}
