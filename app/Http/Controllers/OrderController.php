<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Orders/Index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $order = Order::with(['client.cities', 'status', 'details.product'])->find($id);
        $statuses = Status::all();


        //dd($order);

        return Inertia::render('Orders/Edit', ['order' => $order, 'statuses' => $statuses]);
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
            $input['vendor_id'] = Auth::id();

            $order = Order::create($input);

            foreach ($request->cart as $cart) {
                $detail = Detail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart['productId'],
                    'product_variant' => $cart['variation'],
                    'qty' => $cart['qty'] * $cart['variation'],
                    'up' => $cart['price'] / $cart['variation'],
                    'amount' => $cart['price'] * $cart['qty'],

                ]);

                // Discount stock product
                $product = Product::find($cart['productId']);
                $product->stock = $product->stock - ($detail->qty * $detail->product_variant);
                $product->save();
            }

            $order = $order->load(['client', 'details.product']);

            Mail::to($order->client->email)->send(new OrderMail($order));

            // Obtener correo del admin y despacho
            $users = User::role(['admin', 'despacho'])->pluck('email');
            // Mandar Mail con el detalle del pedido
            Mail::to($users)->send(new OrderMailDetail($order));

            DB::commit();

            return Redirect::route('orders.index');
        } catch (Exception $ex) {
            Log::warning($ex->getMessage());
            DB::rollBack();

            return back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $order = Order::with(['client', 'details'])->find($request->id);
        $titulo = '';
        $img = '';

        // El status_id igual a 3 es cancelado
        if ($request->status_id == Status::CANCELED) {
            $titulo = 'El pedido ha sido cancelado';
            $img = 'pedido_1.jpeg';

            foreach ($order->details as $detail) {

                $product = Product::find($detail->product_id);

                $newstock = $product->stock + ($detail->qty * $detail->product_variant);

                $product->stock =  $newstock;
                $product->save();
            }
        } else if ($request->status_id == Status::DELIVERED) {
            $titulo = '¡ El PEDIDO ESTÁ EN CAMINO !';
            $img = 'pedido_2.jpeg';
        } else if ($request->status_id == Status::PENDING) {
            $titulo = 'El pedido está en preparación';
            $img = 'pedido_1.jpeg';
        }

        $order->status_id = $request->status_id;
        $order->save();

        try {
            // Enviar correo
            $data = array();
            $data['titulo'] = $titulo;
            $data['name'] = $order->client->name . ' ' . $order->client->surname;
            $data['email'] = $order->client->email;
            $data['img'] = $img;

            Mail::send('emails.status', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject($data['titulo']);
            });
        } catch (Exception $ex) {
            Log::warning($ex->getMessage());
        }

        return Redirect::route('orders.index');
    }

    public function getSupportingData()
    {
        $statuses = Status::index(['name as text', 'id as value']);

        return [
            'statuses' => $statuses
        ];
    }

    public function getOrders(Request $request)
    {
        $orders = Order::getAllData($request);

        if (empty($request->reqType)) {
            return ['datarows' => $orders['data'], 'count' => $orders['count']];
        } else {
            return ['datarows' => $orders];
        }
    }

    public function print(Order $order)
    {
        $order = $order->load(['client.cities', 'status', 'details.product']);

        return view('print.order', compact('order'));
    }
}
