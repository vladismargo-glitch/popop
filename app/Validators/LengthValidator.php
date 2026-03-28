<?php
namespace Validators;

use Src\Validator\AbstractValidator;

class LengthValidator extends AbstractValidator
{
    protected string $message = 'Длина поля :field должна быть от :min до :max символов';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }

        $min = $this->args[0] ?? 0;
        $max = $this->args[1] ?? 255;
        $length = mb_strlen($this->value, 'UTF-8');

        $this->messageKeys = [
            ":value" => $this->value,
            ":field" => $this->field,
            ":min" => $min,
            ":max" => $max
        ];

        return $length >= $min && $length <= $max;
    }
}