<?php

namespace Ciosp\Sales\Domain\ValueObjects;

use Ciosp\Shared\Domain\ValueObjects\ValueObject;
use Exception;

final class Email extends ValueObject{

    public function __construct(
        readonly string $email
    ){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception("Invalid email address");
        }
    }

    public function value(): string{
        return $this->email;
    }

    public function __toString(): string{
        return $this->email." toString";
    }
}
