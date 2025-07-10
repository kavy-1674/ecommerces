<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function viewCarts()
    {
        return view('carts.index');
    }
    public function add(Request $request)
    {
        $productId = $request->input('id');
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $productImage = $request->input('image');
        
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "name" => $productName,
                "price" => $productPrice,
                "image" => $productImage,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart); 
        $totalQuantity = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart!',
            'cart' => $cart,
            'totalQuantity' => $totalQuantity,            
        ]);
    }
    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $totalQuantity = array_sum(array_column($cart, 'quantity'));
        
        return response()->json([
            'totalQuantity' => $totalQuantity
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');    
        $action = $request->input('action');

        if (isset($cart[$id])) {
            if ($action == 'increase') {
                $cart[$id]['quantity'] += 1;
            } elseif ($action == 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity'] -= 1;
            }
            session(['cart' => $cart]);
        }

        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }

        $total = isset($cart[$id]) ? $cart[$id]['price'] * $cart[$id]['quantity'] : 0;
        $quantity = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        
        return response()->json([
            'success' => true,
            'cart' => $cart,
            'quantity' => $cart[$id]['quantity'] ?? 0,
            'total' => ($cart[$id]['price'] ?? 0) * ($cart[$id]['quantity'] ?? 0),
            'grandTotal' => $grandTotal,
        ]);
    }

    public function checkOut()
    {
        return view('carts.checkOut');
    }
}
