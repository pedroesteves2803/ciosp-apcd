<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Domain\Entities\Cart;
use Ciosp\Sales\Domain\Repositories\ICartsRepository;

final class AddItemToCart {

    public function __construct(
        readonly ICartsRepository $cartsRepository
    ){}

    public function execute(Cart $cart): void {

        $this->cartsRepository->saveCartItems(
            $cart
        );

    }
}
