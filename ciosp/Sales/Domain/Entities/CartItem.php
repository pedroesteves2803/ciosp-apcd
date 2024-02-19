<?php

namespace Ciosp\Sales\Domain\Entities;

use Ciosp\Shared\Domain\Entities\Entity;
use Ciosp\Shared\Domain\Entities\IAggregator;
use Exception;

final class CartItem extends Entity implements IAggregator{

    public function __construct(
        readonly ?int $id,
        readonly Product $product,
        readonly int $quantity
    ){
        if($quantity < 1){
            throw new Exception("Quantidade de item invalida!");
        }
    }

    public function id(): ?int{
        return $this->id;
    }

    public function setId(int $id) : void{
        $this->id = $id;
    }

    public function product(): Product {
        return $this->product;
    }
}
