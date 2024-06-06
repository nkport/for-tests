<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SessionController extends Controller
{
    public function index()
    {
        // セッションから'product_id'キーの値を取得する
        $product_id = session('product_id');

        $product = Product::find($product_id);

        return view('sessions.index', compact('product'));
    }

    public function create()
    {
        $products = Product::all();

        return view('sessions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        // キー名が'product_id'、値が商品IDのデータをセッションに保存する
        session(['product_id' => $request->input('product_id')]);

        return redirect('/sessions');
    }

    public function destroy()
    {
        // セッションから'product_id'キーとその値を削除する
        session()->forget('product_id');

        return redirect('/sessions');
    }
}
