<?php
declare(strict_types=1);

namespace App\Infrastructure\Validation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;

class PostValidator extends ValidatorAbstract
{
    protected function getConstraints(): Constraint
    {
        return new Constraints\Collection([
            'title' => [
                new Constraints\Required(),
                new Constraints\NotBlank(),
                new Constraints\Type('string'),
                new Constraints\Length(['min' => 10, 'max' => 80])
            ],
            'content' => [
                new Constraints\Required(),
                new Constraints\NotBlank(),
                new Constraints\Type('string'),
                new Constraints\Length(['min' => 20, 'max' => 1000])
            ]
        ]);
    }
}
