<?php

namespace Ciosp\Sales\Application\Dtos;

use Ciosp\Sales\Domain\Entities\Product;
use Ciosp\Shared\Utils\Notification;

final class DeleteItemByProductOutputDto {

    public function __construct(
        readonly ?Product $product,
        readonly Notification $notification
    ){}

}
