<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Domain\Repositories\IProductsRepository;
use Illuminate\Support\Collection;

final class ListProducts {

    public function __construct(
        readonly IProductsRepository $productsRepository
    ){}

    public function execute(): Collection {
        return $this->productsRepository->getAllActive();
    }
}
