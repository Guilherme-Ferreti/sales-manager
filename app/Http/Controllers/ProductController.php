<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        if ($request->search) {
            $products = $this->productRepository->searchByNameOrReference($request->search);
        } else {
            $products = $this->productRepository->all();
        }

        return ProductResource::collection($products);
    }
}
