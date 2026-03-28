<?php
namespace Validators;

use Src\Validator\AbstractValidator;

class AgeValidator extends AbstractValidator
{
    protected string $message = 'Возраст должен быть не менее :min лет';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }

        $minAge = $this->args[0] ?? 18;

        $birthDate = new \DateTime($this->value);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;

        return $age >= $minAge;
    }
}