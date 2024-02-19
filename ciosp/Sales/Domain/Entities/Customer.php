<?php

namespace Ciosp\Sales\Domain\Entities;

use Ciosp\Sales\Domain\ValueObjects\Email;
use Ciosp\Shared\Domain\Entities\Entity;

final class Customer extends Entity{

    public function __construct(
        readonly int $id,
        readonly string $name,
        readonly Email $email
    ){}

    public function id(): int{
        return $this->id;
    }

    public function name(): string{
        return $this->name;
    }

    public function email(): Email{
        return $this->email;
    }

    public function setId(int $id) : void{
        $this->id = $id;
    }

    public function setName(string $name) : void{
        $this->name = $name;
    }

    public function setEmail(Email $email) : void{
        $this->email = $email;
    }
}
