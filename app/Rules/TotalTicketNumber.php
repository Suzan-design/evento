<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TotalTicketNumber implements ValidationRule
{
    protected $capacity;

    public function __construct($capacity)
    {
        $this->capacity = $capacity;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $totalTickets = array_reduce($value, function($carry, $item) {
            return $carry + (isset($item['ticket_number']) ? $item['ticket_number'] : 0);
        }, 0);
        //dd((int) $totalTickets == (int) $this->capacity);

        if ((int) $totalTickets !== (int) $this->capacity) {
            $fail('The total ticket number for all classes must be equal to the event capacity.');
        }
    }
}
