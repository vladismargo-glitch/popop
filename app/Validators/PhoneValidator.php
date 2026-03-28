<?php
namespace Validators;

use Src\Validator\AbstractValidator;

class PhoneValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть корректным номером телефона (формат: +7XXXXXXXXXX или 8XXXXXXXXXX)';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }

        // Очищаем от лишних символов
        $phone = preg_replace('/[^0-9]/', '', $this->value);

        // Проверяем длину (10 или 11 цифр)
        $length = strlen($phone);

        if ($length === 11 && ($phone[0] === '7' || $phone[0] === '8')) {
            return true;
        }

        if ($length === 10) {
            return true;
        }

        return false;
    }
}