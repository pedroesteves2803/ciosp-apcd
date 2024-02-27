<?php

namespace Ciosp\Sales\Application\Dtos;

final class AddItemToCartInputDto {

    public function __construct(
        readonly int $productId,
    ){}

}
