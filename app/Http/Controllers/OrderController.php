<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function index() {
    //     if (!Auth::check()) {
    //         return redirect()->route('login')->with('error', 'You need to log in first.');
    //     }
    //     $products = Product::query();
    //     $user = User::find(Auth::id());
    //     $carts = Orders::where('status', 'on cart')->get();

    //     // Calculate total price
    //     $totalPrice = $carts->sum(function ($cart) {
    //         if (Auth::check() && Auth::user()->id === $cart->user_id) {
    //             return $cart->quantity * $cart->product->price;
    //         }
    //         return 0;
    //     });

    //     // Convert totalPrice to an integer
    //     $totalPrice = max(round($totalPrice), 1); // Round to the nearest integer and ensure it's at least 1

    //     $userCarts = $carts->filter(function($cart) {
    //         return Auth::check() && Auth::user()->id === $cart->user_id;
    //     });

    //     $products = $products->get();

    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = 'SB-Mid-server-fE9sJHEuT2EWOCtkGFoEG7mA';
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;

    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => rand(), // Consider using a more deterministic order ID
    //             'gross_amount' => $totalPrice, // Ensure this is an integer value without decimals
    //         ],
    //         'customer_details' => [
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'phone' => $user->phone ?? '08111222333',
    //         ],
    //     ];

    //     $snapToken = \Midtrans\Snap::getSnapToken($params);

    //     return view('user.cart', compact('products', 'user', 'carts', 'totalPrice', 'userCarts', 'snapToken'));
    // }
    public function index() {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }
        
        $user = User::find(Auth::id());
    
        // Check if the user has filled in their address
        if (empty($user->address)) {
            return redirect()->route('user.profile.edit')->with('error', 'Please update your address before proceeding to checkout.');
        }
    
        $products = Product::query();
        $carts = Orders::where('status', 'on cart')->where('user_id', Auth::id())->get();
    
        // Default ongkir (shipping fee)
        $defaultOngkir = 10000;
    
        // Calculate total price
        $totalPrice = $carts->sum(function ($cart) {
            if (Auth::check() && Auth::user()->id === $cart->user_id) {
                return $cart->quantity * $cart->product->price;
            }
            return 0;
        });
    
        // Set ongkir to 0 if no items in cart
        if ($carts->isEmpty()) {
            $defaultOngkir = 0;
        }
    
        // Add ongkir to totalPrice
        $totalPrice += $defaultOngkir;
    
        // Convert totalPrice to an integer
        $totalPrice = max(round($totalPrice), 1);
    
        $userCarts = $carts->filter(function($cart) {
            return Auth::check() && Auth::user()->id === $cart->user_id;
        });
    
        $products = $products->get();
    
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-fE9sJHEuT2EWOCtkGFoEG7mA';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'name' => $user->name,
                'email' => $user->email,
                'address' => $user->address,
            ],
        ];
    
        $snapToken = \Midtrans\Snap::getSnapToken($params);
    
        return view('user.cart', compact('products', 'user', 'carts', 'totalPrice', 'userCarts', 'snapToken', 'defaultOngkir'));
    }
    

    public function store($id){
        $product = Product::find($id);
        $userId = Auth::user()->id;

        $cartItem = Orders::where('product_id', $product->id)->where('user_id', $userId)->where('status', 'on cart')->first();
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Orders::create([
                'product_id' => $product->id,
                'user_id' => $userId,
                'quantity' => 1,
                'status' => 'on cart'
            ]);
        }
        return redirect()->back()->with('status', 'Berhasil menambah ke keranjang');
    }

    public function update(Request $request, $id){
        $id = $request->id;
        $quantity = $request->quantity;

        Orders::find($id)->update(['quantity' => $quantity]);

        return redirect()->back()->with('status', 'Product Updated');
    }

    public function destroy($id){
        $Orders = Orders::find($id);
        if ($Orders) {
            $Orders->delete();
            return redirect()->back()->with('status', 'Product removed from cart');
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }

// public function paid(Request $request)
// {
//     $payload = $request->all();
//     $transaction_status = $payload['transaction_status'];

//     if($transaction_status == 'capture' || $transaction_status == 'settlement') {
//         // Get the user's cart items
//         $carts = Orders::where('status', 'on cart')->where('user_id', Auth::id())->get();

//         // Create a new invoice number
//         $invoice = Orders::orderBy('invoice_number', 'desc')->first();
//         $invoiceNumber = $invoice ? $invoice->invoice_number + 1 : 1;

//         foreach ($carts as $order) {
//             $product = $order->product;
//             if ($product) {
//                 // Update product stock
//                 $stockA = $product->stock - $order->quantity;
//                 $product->update(['stock' => $stockA]);
//             }

//             // Update order status to 'paid' and assign invoice number
//             $order->update([
//                 'status' => 'paid',
//                 'invoice_number' => $invoiceNumber,
//             ]);
//         }

//         // Optionally, clear the cart after successful payment
//         Orders::where('status', 'on cart')->where('user_id', Auth::id())->delete();

//         return response()->json(['status' => 'success']);
//     }

//     return response()->json(['status' => 'failure']);
// }

public function handleMidtransNotification(Request $request)
{
    $payload = $request->all();
    $transaction_status = $payload['transaction_status'] ?? null;

    if ($transaction_status === 'capture' || $transaction_status === 'settlement') {
        $carts = Orders::where('status', 'on cart')->where('user_id', Auth::id())->get();

        $invoice = Orders::orderBy('invoice_number', 'desc')->first();
        $invoiceNumber = $invoice ? $invoice->invoice_number + 1 : 1;

        foreach ($carts as $order) {
            $product = $order->product;
            if ($product) {
                $product->decrement('stock', $order->quantity);
            }

            $order->update([
                'status' => 'paid',
                'invoice_number' => $invoiceNumber,
            ]);
        }

        Orders::where('status', 'on cart')->where('user_id', Auth::id())->delete();

        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'failure']);
}



}
