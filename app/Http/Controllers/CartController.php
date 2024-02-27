<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Ciosp\Sales\Application\AddItemToCart;
use Ciosp\Sales\Application\CreateItemOrder;
use Ciosp\Sales\Application\DeleteItemByProduct;
use Ciosp\Sales\Application\Dtos\AddItemToCartInputDto;
use Ciosp\Sales\Application\Dtos\DeleteItemByProductInputDto;
use Ciosp\Sales\Application\GetCustomerById;
use Ciosp\Sales\Application\RetrieveOrCreateActiveCart;
use Ciosp\Sales\Application\GetProductById;
use Ciosp\Sales\Application\GetUserById;
use Ciosp\Sales\Domain\Entities\CartItem;
use Ciosp\Shared\Utils\Notification;

class CartController extends Controller
{
    public function store(
        int $productId,
        AddItemToCart $addItemToCart
    ){
        $output = $addItemToCart->execute(
            new AddItemToCartInputDto($productId)
        );

        if($output->notification->hasErrors()){
            return redirect()->route('index')->with('errors', $output->notification->getErrors());
        }

        return redirect()->route('index')->with('message', $output->product->name. " adicionado!");
    }

    public function delete(
        int $productId,
        DeleteItemByProduct $deleteItemByProduct
    ){
        $output = $deleteItemByProduct->execute(
            new DeleteItemByProductInputDto($productId)
        );

        if($output->notification->hasErrors()){
            return redirect()->route('index')->with('errors', $output->notification->getErrors());
        }

        return redirect()->route('index')->with('message', $output->product->name. " removido do carrinho!");
    }
}
