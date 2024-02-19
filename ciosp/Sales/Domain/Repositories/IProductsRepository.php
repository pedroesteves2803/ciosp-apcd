<?php

namespace Ciosp\Sales\Domain\Repositories;

use Ciosp\Sales\Domain\Entities\Product;
use Illuminate\Support\Collection;

interface IProductsRepository {

    public function getAllActive(): Collection;

    public function getById(int $id): ?Product;
}
