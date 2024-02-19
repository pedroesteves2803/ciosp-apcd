<?php

namespace Ciosp\Sales\Domain\Entities;

use Ciosp\Sales\Domain\ValueObjects\Email;
use Ciosp\Shared\Domain\Entities\Entity;
use Exception;

final class Product extends Entity{

    public function __construct(
        readonly int $id,
        readonly string $name,
        readonly float $price
    ){
        if(is_numeric($name)){
            throw new Exception("Nome invalido!");
        }

        if($price < 0){
            throw new Exception("Preço invalido!");
        }
    }

    public function id(): int{
        return $this->id;
    }

    public function name(): string{
        return $this->name;
    }

    public function price(): float{
        return $this->price;
    }

    public function setId(int $id) : void{
        $this->id = $id;
    }

    public function setName(string $name) : void{
        $this->name = $name;
    }

    public function setPrice(float $price) : void{
        $this->price = $price;
    }
}
