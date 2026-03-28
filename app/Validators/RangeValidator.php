<?php
namespace Validators;

use Src\Validator\AbstractValidator;

class RangeValidator extends AbstractValidator
{
    protected string $message = 'Значение поля :field должно быть от :min до :max';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }

        if (!is_numeric($this->value)) {
            return false;
        }

        $min = $this->args[0] ?? 0;
        $max = $this->args[1] ?? 999999;
        $value = (float)$this->value;

        $this->messageKeys = [
            ":value" => $this->value,
            ":field" => $this->field,
            ":min" => $min,
            ":max" => $max
        ];

        return $value >= $min && $value <= $max;
    }
}