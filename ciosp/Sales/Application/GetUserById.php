<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Repositories\ICustomersRepository;

final class GetUserById {

    public function __construct(
        readonly ICustomersRepository $iCustomersRepository,
    ){}

    public function execute(int $userId): ?Customer{
        return $this->iCustomersRepository->getById($userId);
    }
}
