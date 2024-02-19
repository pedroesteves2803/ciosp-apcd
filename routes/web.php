<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Ciosp\Sales\Domain\Repositories\ICustomerRepository;
use Ciosp\Sales\Domain\Repositories\IOrdersRepository;
use Ciosp\Sales\Domain\Repositories\IProductsRepository;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('carrinho/adicionar/{id}', [CartController::class, 'store'])->name('cart.add');

// Route::get('/pedido/adicionar/{id}', function(
//     int $id,
//     IProductsRepository $iProductsRepository,
//     ICustomerRepository $iCustomerRepository,
//     IOrdersRepository $iOrdersRepository,
// ){

//     $product = $iProductsRepository->getById($id);

//     if(is_null($product)){
//         echo "Produto invalido";
//         return;
//     }

//     $user = $iCustomerRepository->getById(1);

//     $order =

//     // AddProductToOrder();
// })->name('order.add');
