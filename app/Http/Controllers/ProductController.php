<?php

namespace App\Http\Controllers;

use Ciosp\Sales\Application\GetCartOfTheUserLogged;
use Ciosp\Sales\Application\ListProducts;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        ListProducts $listProducts,
        GetCartOfTheUserLogged $getCartOfTheUserLogged
    )
    {
        $products = $listProducts->execute();
        $cart = $getCartOfTheUserLogged->execute();

        return view('product.index', compact('products', 'cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
