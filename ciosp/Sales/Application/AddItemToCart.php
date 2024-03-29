<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Application\Dtos\AddItemToCartInputDto;
use Ciosp\Sales\Application\Dtos\AddItemToCartOutputDto;
use Ciosp\Sales\Domain\Entities\Cart;
use Ciosp\Sales\Domain\Entities\CartItem;
use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Entities\Product;
use Ciosp\Sales\Domain\Repositories\ICartsRepository;
use Ciosp\Shared\Utils\Notification;

final class AddItemToCart {

    public Notification $notification;

    public function __construct(
        readonly ICartsRepository $cartsRepository,
        readonly GetProductById $getProductById,
        readonly GetCustomerById $getCustomerById,
        readonly RetrieveOrCreateActiveCart $retrieveOrCreateActiveCart
    ){
        $this->notification = new Notification();
    }

    public function execute(AddItemToCartInputDto $input): AddItemToCartOutputDto {

        $product = $this->resolveProductById($input->productId);

        if($product instanceof Notification){
            return new AddItemToCartOutputDto(
                null,
                $this->notification
            );
        }

        $cartItem = $this->hydrateCartItem($product);

        $cart = $this->addItemToCartInMemory($cartItem);

        $this->cartsRepository->saveCartItems(
            $cart
        );

        return new AddItemToCartOutputDto(
            $product,
            $this->notification
        );
    }

    private function resolveProductById(int $productId): Product | Notification {
        $product = $this->getProductById->execute($productId);

        if(is_null($product)){
            return $this->notification->addError([
                'context' => 'product_not_found',
                'message' => 'Product não encontrado!',
            ]);
        }

        return $product;
    }

    private function resolveCustomerById(int $userId) : Customer | Notification {
        $customer = $this->getCustomerById->execute($userId);

        if(is_null($customer)){
            return $this->notification->addError([
                'context' => 'customer_not_found',
                'message' => 'Cliente não encontrado!',
            ]);
        }

        return $customer;
    }

    private function hydrateCartItem(Product $product): CartItem{

        return new CartItem(
            null,
            $product,
            1
        );
    }

    private function addItemToCartInMemory(CartItem $cartItem): Cart {

        $user = $this->resolveCustomerById(1);

        $cart = $this->retrieveOrCreateActiveCart->execute($user);
        $cart->addItem($cartItem);

        return $cart;
    }
}
