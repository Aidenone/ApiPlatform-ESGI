<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class LogicDateBorrow extends Constraint
{
    public $message = 'The borrowing date must be before the return date.';
}