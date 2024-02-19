<?php

namespace Ciosp\Sales\Domain\Entities;

use Ciosp\Shared\Domain\Entities\Entity;
use Ciosp\Shared\Domain\Entities\IAggregateRoot;
use Illuminate\Support\Collection;

final class Cart extends Entity implements IAggregateRoot{

    private $items;

    public function __construct(
        readonly int $id,
        readonly Customer $customer
    ){
        $this->items = new Collection();
    }

    public function id(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function addItem(CartItem $cartItem): void{
        $this->items->push($cartItem);
    }

    public function items(): Collection{
        return $this->items;
    }
}
