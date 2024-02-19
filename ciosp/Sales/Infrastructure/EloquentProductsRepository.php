<?php

namespace Ciosp\Sales\Infrastructure;

use App\Models\Product as ProductModel;
use Ciosp\Sales\Domain\Entities\Product;
use Ciosp\Sales\Domain\Repositories\IProductsRepository;
use Illuminate\Support\Collection;

final class EloquentProductsRepository implements IProductsRepository{

    public function getAllActive(): Collection {
        $productsModel = ProductModel::where('active', true)->get();

        return $productsModel->map(function (ProductModel $product) {
            return new Product(
                $product->id,
                $product->name,
                $product->price
            );
        });
    }

    public function getById(int $id): ?Product {
        $productModel = ProductModel::find($id);

        if(is_null($productModel)){
            return null;
        }

        return new Product(
            $productModel->id,
            $productModel->name,
            $productModel->price
        );
    }

}
