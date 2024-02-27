<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Repositories\ICustomersRepository;

final class GetCustomerById {

    public function __construct(
        readonly ICustomersRepository $customersRepository,
    ){}

    public function execute(int $customerId): ?Customer{
        return $this->customersRepository->getById($customerId);
    }
}
