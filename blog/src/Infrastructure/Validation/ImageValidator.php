<?php
declare(strict_types=1);

namespace App\Infrastructure\Validation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;

class ImageValidator extends ValidatorAbstract
{
    protected function getConstraints(): Constraint
    {
        return new Constraints\Collection([
            'file' => [
                new Constraints\File(maxSize: '1M', mimeTypes: 'image/jpeg')
            ]
        ]);
    }
}
