<?php

namespace Ciosp\Sales\Infrastructure;

use App\Models\Order as ModelsOrder;
use App\Models\OrderItem;
use Ciosp\Sales\Domain\Entities\Order;
use Ciosp\Sales\Domain\Entities\Product;
use Ciosp\Sales\Domain\Repositories\IOrderItemRepository;
use Ciosp\Sales\Domain\Repositories\IOrdersRepository;
use Ciosp\Sales\Domain\Repositories\IProductsRepository;
use Illuminate\Support\Collection;

final class EloquentOrderItemRepository implements IOrderItemRepository{

    public function execute(int $orderId, int $productId, int $quantity): int {
        $orderItem = new OrderItem();

        $orderItem->order_id = $orderId;
        $orderItem->product_id = $productId;
        $orderItem->quantity = $quantity;
        $orderItem->save();

        return $orderItem->id;
    }


}
