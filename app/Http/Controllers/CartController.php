<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\order_items;
use App\Models\PaymentModel;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnValue;

class CartController extends Controller
{
    public function addToCart(Products $products, Request $request)
    {
        $fields = $request->validate(['quantity' => ['required', 'integer', 'min:1']]);
        $cart = session()->get('cart', []);
        if (isset($cart['$products->id'])) {
            return response()->json(['status' => 'error', 'message' => 'Product already in cart']);
        }
        if ($fields['quantity'] > $products->quantity_in_stock) {
            return response()->json(['status' => 'error', 'message' => 'Quantity exceeds inventory']);
        }
        $cart[$products->id] = [
            'id' => $products->id,
            'quantity' => $fields['quantity'],
        ];
        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'message' => 'Product added to cart']);
    }

    function viewCart()
    {
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Products::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $cart[$product->id]['product_name'] = $product->product_name;
            $cart[$product->id]['price'] = $product->price;
            $cart[$product->id]['image_product'] = $product->image_product;
        }
        return view('main.cart', compact('cart'));
        /*
       This way is not correct 100%...
       foreach($cart as $item){
            $product = Product::find($item['id']);
            $item['name'] = $product->name;
        }
        time complexity :
        O(1) O(n) */
    }

    function cartDecrement(Products $products)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$products->id])) {
            return response()->json(['status' => 'error', 'message' => 'Product not in cart']);
        }

        if ($cart[$products->id]['quantity'] <= 1) {
            $cart[$products->id]['quantity'] = 1;
            session()->put('cart', $cart);
            return response()->json(['status' => 'error', 'message' => 'Minimum quantity is 1']);
        }

        $cart[$products->id]['quantity'] -= 1;
        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'message' => 'Quantity updated']);
    }

    function cartIncrement(Products $products)
    {
        $cart = session()->get('cart', []);
        if (!isset($cart[$products->id])) {
            return response()->json(['status' => 'error', 'message' => 'Product not in cart']);
        }

        if ($cart[$products->id]['quantity'] >= $products->quantity_in_stock) {
            $cart[$products->id]['quantity'] = $products->quantity_in_stock;
            session()->put('cart', $cart);
            return response()->json(['status' => 'error', 'message' => 'Already at max']);
        }

        $cart[$products->id]['quantity'] += 1;
        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'message' => 'Quantity updated']);
    }

    function cartRemove(Products $products)
    {
        $cart = session()->get('cart', []);
        unset($cart[$products->id]);
        session()->put('cart', $cart);
        //return redirect()->back();
        return response()->json(['status' => 'success', 'message' => 'Done']);
    }

    function checkoutPage()
    {
        $paymentMethods = PaymentModel::all();
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Products::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $cart[$product->id]['product_name'] = $product->product_name;
            $cart[$product->id]['price'] = $product->price;
            $cart[$product->id]['image_product'] = $product->image_product;
        }
        return view('main.checkout', compact('cart', 'paymentMethods'));
    }

    function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            $request->validate([
                'guest_name'  => 'required|string|max:255',
                'guest_email' => 'required|email|max:255',
                'address'     => 'required|string|max:255',
                'phone'       => 'required|string|max:255',
            ]);
        } else {
            $request->validate([
                'address' => 'required|string|max:255',
            ]);
        }

        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Products::whereIn('id', $productIds)->get();

        $order = Order::create([
            'user_id'     => Auth::check() ? Auth::id() : null,
            'payment_id'  => $request->payment_id,
            'address'     => $request->address,
            'phone'       => $request->phone,
            'guest_name'  => $request->guest_name,
            'guest_email' => $request->guest_email,
        ]);


        foreach ($products as $product) {

            $quantity = $cart[$product->id]['quantity'];

            // Prevent exceeding stock
            if ($quantity > $product->quantity_in_stock) {
                $quantity = $product->quantity_in_stock;
            }

            // Update stock
            $product->quantity_in_stock -= $quantity;
            $product->save();

            // Create order item
            order_items::create([
                'order_id'  => $order->id,
                'product_id' => $product->id,
                'quantity'  => $quantity,
                'price'     => $product->price,
            ]);
        }

        session()->forget('cart');

        return redirect()->back();
    }
}
