<?php

namespace Ciosp\Sales\Domain\Repositories;

use Ciosp\Sales\Domain\Entities\Cart;
use Ciosp\Sales\Domain\Entities\CartItem;
use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Entities\Product;
use Illuminate\Support\Collection;

interface ICartsRepository {

    public function retrieveOrCreateActiveCart(Customer $customer): Cart;
    public function saveCartItems(Cart $cart): void;
    public function byCustomer(Customer $customer): Cart;
    public function deleteCartItemByProduct(Product $removedProduct, Cart $cart): void;
}
