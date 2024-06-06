<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create()
    {
        return view('requests.create');
    }

    public function confirm(Request $request)
    {
        // HTTPリクエストに含まれる、単一のパラメータの値を取得する
        $user_name = $request->input('user_name');
        $user_email = $request->input('user_email');
        $user_gender = $request->input('user_gender');
        $category = $request->input('category');
        $message = $request->input('message');

        // HTTPリクエストメソッド（GET、POST、PUT、PATCH、DELETEなど）を取得する
        $method = $request->method();

        // HTTPリクエストのパスを取得する
        $path = $request->path();

        // HTTPリクエストのURLを取得する
        $url = $request->url();

        // HTTPリクエストを送信したクライアントのIPアドレスを取得する
        $ip = $request->ip();

        $variables = [
            'user_name',
            'user_email',
            'user_gender',
            'category',
            'message',
            'method',
            'path',
            'url',
            'ip'
        ];

        return view('requests.confirm', compact($variables));
    }
}