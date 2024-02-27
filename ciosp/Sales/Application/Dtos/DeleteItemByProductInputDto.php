<?php

namespace Ciosp\Sales\Application\Dtos;

final class DeleteItemByProductInputDto {

    public function __construct(
        readonly int $productId,
    ){}

}
