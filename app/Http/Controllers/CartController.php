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
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($id);
        $quantity = $request->quantity;
        
        // Validasi stok lebih ketat
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi! Stok tersedia: ' . $product->stock);
        }

        $cart = session()->get('cart', []);

        // Jika produk sudah ada di cart, jumlahkan quantity
        if(isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;
            if ($product->stock < $newQuantity) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi untuk menambah quantity!');
            }
            $cart[$id]['quantity'] = $newQuantity;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->id);
        
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $product->stock);
        }

        $cart = session()->get('cart');
        
        if (!$cart || !isset($cart[$request->id])) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang!');
        }
        
        $cart[$request->id]["quantity"] = $request->quantity;
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Keranjang berhasil diupdate!');
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