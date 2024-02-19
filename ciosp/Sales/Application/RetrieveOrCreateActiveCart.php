<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Domain\Entities\Cart;
use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Repositories\ICartsRepository;

final class RetrieveOrCreateActiveCart {

    public function __construct(
        readonly ICartsRepository $cartRepository
    ){}


    public function execute(Customer $customer): Cart {
        return $this->cartRepository->retrieveOrCreateActiveCart($customer);
    }
}
