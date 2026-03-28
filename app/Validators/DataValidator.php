<?php
namespace Validators;

use Src\Validator\AbstractValidator;

class DateValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть корректной датой (формат: ГГГГ-ММ-ДД)';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }

        $date = \DateTime::createFromFormat('Y-m-d', $this->value);

        if (!$date) {
            return false;
        }

        // Проверяем, что дата реальная
        return $date->format('Y-m-d') === $this->value;
    }
}