<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Domain\Entities\Order;
use Ciosp\Sales\Domain\Entities\Product;
use Ciosp\Sales\Domain\Repositories\IOrdersRepository;
use Ciosp\Sales\Domain\Repositories\IProductsRepository;
use Illuminate\Support\Collection;

final class GetProductById {

    public function __construct(
        readonly IProductsRepository $iProductsRepository
    ){}


    public function execute(int $productId): ?Product{
        return $this->iProductsRepository->getById($productId);
    }
}
