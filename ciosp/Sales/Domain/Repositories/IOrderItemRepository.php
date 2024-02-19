<?php

namespace Ciosp\Sales\Domain\Repositories;

use Ciosp\Sales\Domain\Entities\Order;
use Ciosp\Sales\Domain\Entities\OrderItem;
use Ciosp\Sales\Domain\Entities\Product;

interface IOrderItemRepository {

    public function execute(int $orderId, int $productId, int $quantity): int;
}
