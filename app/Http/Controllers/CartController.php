<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

   public function add(Request $request, $id)
{
    $request->validate([
        'quantity' => 'sometimes|integer|min:1'
    ]);

    $product = Product::findOrFail($id);
    
    // Cek stok
    $quantity = $request->quantity ?? 1;
    if ($product->stock < $quantity) {
        return redirect()->back()->with('error', 'Stok produk tidak mencukupi!');
    }

    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['quantity'] += $quantity;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
}

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Keranjang berhasil diupdate!');
        }
        
        return redirect()->back()->with('error', 'Gagal update keranjang.');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
        }
        
        return redirect()->back()->with('error', 'Gagal menghapus produk.');
    }
}