<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Ciosp\Sales\Application\AddItemToCart;
use Ciosp\Sales\Application\CreateItemOrder;
use Ciosp\Sales\Application\RetrieveOrCreateActiveCart;
use Ciosp\Sales\Application\GetProductById;
use Ciosp\Sales\Application\GetUserById;
use Ciosp\Sales\Domain\Entities\CartItem;
use Ciosp\Sales\Domain\Entities\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(
        int $productId,
        GetProductById $getProductById,
        GetUserById $getUserById,
        RetrieveOrCreateActiveCart $retrieveOrCreateActiveCart,
        AddItemToCart $addItemToCart
    ){
        try{
            $product = $getProductById->execute($productId);

            if(is_null($product)){
                echo "Produto invalido";
                return;
            }

            $user = $getUserById->execute(1);

            if(is_null($user)){
                echo "User invalido";
                return;
            }

            $cartItem = new CartItem(
                null,
                $product,
                1
            );

            $cart = $retrieveOrCreateActiveCart->execute($user);
            $cart->addItem($cartItem);

            $addItemToCart->execute($cart);

            return redirect()->route('index')->with('message', $product->name. " adicionado!");
        }catch (\Exception $exception){
            dd($exception->getMessage());
            return redirect()->route('index')->with('message', "Falha ao adicionar o produto: ". $product->name. "!");
        }
    }
}
