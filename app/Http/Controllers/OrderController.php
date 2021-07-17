<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $addressRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, AddressRepositoryInterface $addressRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->addressRepository = $addressRepository;
    }

    public function index()
    {
        return OrderResource::collection($this->orderRepository->with(['products', 'address'])->all());
    }

    public function store(OrderRequest $request)
    {
        $attributes = $request->validated();

        $order = $this->orderRepository->create($attributes);

        $this->addressRepository->create($attributes['address'] + ['order_id' => $order->id]);

        foreach ($attributes['products'] as $product) {
            $this->orderRepository->attachProduct($order->id, $product);
        }

        return new OrderResource($this->orderRepository->with(['products', 'address'])->findById($order->id));
    }
}
