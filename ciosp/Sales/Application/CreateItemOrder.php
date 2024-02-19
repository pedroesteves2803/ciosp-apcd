<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Domain\Entities\Order;
use Ciosp\Sales\Domain\Entities\OrderItem;
use Ciosp\Sales\Domain\Entities\Product;
use Ciosp\Sales\Domain\Repositories\IOrderItemRepository;
use Ciosp\Sales\Domain\Repositories\IProductsRepository;
use Illuminate\Support\Collection;

final class CreateItemOrder {

    public function __construct(
        readonly IOrderItemRepository $iOrderItemRepository
    ){}

    public function execute(int $orderId, int $productId, int $quantity): int {
        return $this->iOrderItemRepository->execute($orderId, $productId, $quantity);
    }
}
