<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
final class LogicDateBorrowValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
    	$date = $this->context->getRoot()->getBorrowingDate();
        if ($value < $date) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}