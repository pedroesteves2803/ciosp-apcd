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

        $modelsCart = ModelsCart::where('user_id', $customer->id)->first();

        if(is_null($modelsCart)){
            $modelsCart = new ModelsCart();
            $modelsCart->user_id = $customer->id;
            $modelsCart->save();
        }

        $cart =  new Cart(
            $modelsCart->id,
            $customer
        );

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

    public function saveCartItems(Cart $cart): void {
        $cart->items()->map(function(CartItem $cartItem) use ($cart) {
            $modelCartItem = new ModelsCartItem();

            $modelCartItem->cart_id = $cart->id;
            $modelCartItem->product_id = $cartItem->product->id;
            $modelCartItem->quantity = $cartItem->quantity;
            $modelCartItem->save();
        });
    }

    public function deleteCartItemByProduct(Product $removedProduct, Cart $cart): void {
        ModelsCartItem::where([
            'cart_id' => $cart->id,
            'product_id' => $removedProduct->id
        ])->delete();
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
