<?php

namespace Ciosp\Sales\Domain\Repositories;

use Ciosp\Sales\Domain\Entities\Customer;

interface ICustomersRepository {

    public function getById(int $id): ?Customer;
}
