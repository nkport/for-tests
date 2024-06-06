<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function show($id)
    {
        // URL'/vendors/{id}'の'{id}'部分と主キー（idカラム）の値が一致するデータをvendorsテーブルから取得し、変数$vendorに代入する
        $vendor = Vendor::find($id);

        // インスタンスに紐づくproductsテーブルのすべてのデータをインスタンスのコレクションとして取得する
        $products = $vendor->products;

        // 変数$vendorと変数$productsをvendors/show.blade.phpファイルに渡す
        return view('vendors.show', compact('vendor', 'products'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        // バリデーションを設定する
        $request->validate([
            'vendor_code' => 'required|integer|min:0|unique:vendors,vendor_code',
            'vendor_name' => 'required|max:255'
        ]);

        // フォームの入力内容をもとに、テーブルにデータを追加する
        $vendor = new Vendor();
        $vendor->vendor_code = $request->input('vendor_code');
        $vendor->vendor_name = $request->input('vendor_name');
        $vendor->save();

        // リダイレクトさせる
        return redirect("/vendors/{$vendor->id}");
    }
}
