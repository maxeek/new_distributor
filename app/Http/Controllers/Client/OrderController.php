<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Mail\OrderMailDetail;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $query = Order::with(['client', 'status'])->where('client_id', Auth::guard('client')->id());

        if (request('search')) {
            $query->where('status_id', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Client/Orders/Index', [

            'orders' => $query->paginate(10)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

    public function show($id)
    {
        $order = Order::with(['client', 'status', 'details.product'])->find($id);

        return Inertia::render('Client/Orders/Show', [
            'order' => $order
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required',
            'hour' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $input = $request->all();
            $input['status_id'] = Status::PENDING;
            $input['date'] = now();
            $input['client_id'] = Auth::guard('client')->id();

            $order = Order::create($input);

            foreach ($request->cart as $cart) {
                $detail = Detail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart['productId'],
                    'product_variant' => $cart['variation'],
                    'qty' => $cart['qty'],
                    'up' => $cart['price'],
                    'amount' => $cart['price'] * $cart['qty'],
                ]);

                // Discount stock product
                $product = Product::find($cart['productId']);
                $product->stock = $product->stock - ($detail->qty * $detail->product_variant);
                $product->save();
            }

            Mail::to($order->client->email)->send(new OrderMail($order));

            // Obtener correo del admin y despacho
            $users = User::role(['admin', 'despacho'])->pluck('email');
            // Mandar Mail con el detalle del pedido
            Mail::to($users)->send(new OrderMailDetail($order));

            DB::commit();

            return Redirect::route('client.orders.index');
        } catch (Exception $ex) {
            Log::warning($ex->getMessage());
            DB::rollBack();

            return back()->withErrors($ex->getMessage());
        }
    }
}
