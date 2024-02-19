<?php

namespace Ciosp\Sales\Infrastructure;

use App\Models\Cart as ModelsCart;
use App\Models\CartItem as ModelsCartItem;
use Ciosp\Sales\Domain\Entities\Cart;
use Ciosp\Sales\Domain\Entities\CartItem;
use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Entities\Product;
use Ciosp\Sales\Domain\Repositories\ICartsRepository;

final class EloquentCartsRepository implements ICartsRepository{

    public function retrieveOrCreateActiveCart(Customer $customer): Cart {

        $cart = ModelsCart::where('user_id', $customer->id)->first();

        if(is_null($cart)){
            $cart = new ModelsCart();
            $cart->user_id = $customer->id;
            $cart->save();
        }

        return new Cart(
            $cart->id,
            $customer
        );
    }

    public function saveCartItems(Cart $cart): void {
        $cart->items()->map(function(CartItem $cartItem) use ($cart) {
            $modelCartItem = new ModelsCartItem();

            $modelCartItem->cart_id = $cart->id;
            $modelCartItem->product_id = $cartItem->product->id;
            $modelCartItem->quantity = $cartItem->quantity;
            $modelCartItem->save();
        });
    }

    public function byCustomer(Customer $customer): Cart {
        $cart = $this->retrieveOrCreateActiveCart($customer);

        $modelCartItem = ModelsCartItem::where('cart_id', $cart->id)->get();

        $modelCartItem->map(function (ModelsCartItem $modelCartItem) use ($cart){
            $cart->addItem(new CartItem(
                $modelCartItem->id,
                new Product(
                    $modelCartItem->product->id,
                    $modelCartItem->product->name,
                    $modelCartItem->product->price,
                ),
                $modelCartItem->quantity
            ));
        });

        return $cart;
    }
}
