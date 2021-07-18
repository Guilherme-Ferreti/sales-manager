<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Rules\BrazilianState;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository, AddressRepositoryInterface $addressRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->addressRepository = $addressRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->with('products')->all();

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, int $order_id)
    {
        $order = $this->orderRepository->with('products', 'address')->findById($order_id);

        return view('orders.show', compact('order'));
    }

    public function create()
    {
        $states = BrazilianState::STATES;

        return view('orders.create', compact('states'));
    }

    public function store(OrderRequest $request)
    {
        $attributes = $request->validated();

        $order = $this->orderRepository->create($attributes);

        $this->addressRepository->create($attributes['address'] + ['order_id' => $order->id]);

        foreach ($attributes['products'] as $product) {
            $this->orderRepository->attachProduct($order->id, $product);
        }

        return redirect()->route('orders.show', $order);
    }
}
