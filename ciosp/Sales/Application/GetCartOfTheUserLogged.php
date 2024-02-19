<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Domain\Entities\Cart;
use Ciosp\Sales\Domain\Entities\CartItem;
use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Repositories\ICartsRepository;
use Ciosp\Sales\Domain\Repositories\ICustomersRepository;

final class GetCartOfTheUserLogged {

    public function __construct(
        readonly ICartsRepository $cartsRepository,
        readonly ICustomersRepository $iCustomersRepository,
    ){}

    public function execute(): Cart {

        $customer = $this->iCustomersRepository->getById(1);

        return $this->cartsRepository->byCustomer($customer);
    }
}
