<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{

    public function create()
    {
        return view('sign-in.create');
    }

    public function store(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // 入力されたメールアドレスに一致するユーザーを取得する
        $user = User::where('email', $email)->first();

        // ユーザーが存在し、かつ入力された平文のパスワードがハッシュ化されたパスワードと一致するかどうかを確認する
        if ($user && Hash::check($password, $user->password)) {
            return "ログインに成功しました。";
        } else {
            return "ログインに失敗しました。";
        }
    }
    

}