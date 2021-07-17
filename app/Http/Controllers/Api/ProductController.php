<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
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
