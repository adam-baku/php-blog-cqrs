<?php
declare(strict_types=1);

namespace App\Infrastructure\Validation\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \RuntimeException
{
    private ConstraintViolationListInterface $violationList;

    public static function withViolationList(ConstraintViolationListInterface $violationList): self
    {
        $self = new self('Validation fail.', 400);
        $self->violationList = $violationList;

        return $self;
    }

    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->violationList;
    }
}
