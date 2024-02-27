<?php

namespace Ciosp\Sales\Application;

use Ciosp\Sales\Application\Dtos\DeleteItemByProductInputDto;
use Ciosp\Sales\Application\Dtos\DeleteItemByProductOutputDto;
use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Entities\Product;
use Ciosp\Sales\Domain\Repositories\ICartsRepository;
use Ciosp\Shared\Utils\Notification;

final class DeleteItemByProduct {

    public Notification $notification;

    public function __construct(
        readonly ICartsRepository $cartsRepository,
        readonly GetProductById $getProductById,
        readonly GetCustomerById $getCustomerById,
        readonly RetrieveOrCreateActiveCart $retrieveOrCreateActiveCart
    ){
        $this->notification = new Notification();
    }

    public function execute(DeleteItemByProductInputDto $input): DeleteItemByProductOutputDto {
        $product = $this->resolveProductById($input->productId);
        $customer = $this->resolveCustomerById(1);

        if($product instanceof Notification or $customer instanceof Notification){
            return new DeleteItemByProductOutputDto(
                null,
                $this->notification
            );
        }

        $cart = $this->retrieveOrCreateActiveCart->execute($customer);
        $cart->deleteItemByProduct($product);

        $this->cartsRepository->deleteCartItemByProduct($product, $cart);

        return new DeleteItemByProductOutputDto(
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

    private function resolveCustomerById(int $customerId): Customer | Notification {
        $customer = $this->getCustomerById->execute($customerId);

        if(is_null($customer)){
            return $this->notification->addError([
                'context' => 'customer_not_found',
                'message' => 'Customer não encontrado!',
            ]);
        }

        return $customer;
    }
}
