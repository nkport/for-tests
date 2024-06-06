<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        // return 'Hello, world!';
        // return view('index');
        $name = '侍 太郎';
        $languages = ['HTML', 'CSS', 'JavaScript', 'PHP'];

        // 変数$nameをindex.blade.phpファイルに渡す
        // return view('index', compact('name'));

        // 変数$name、$languagesをindex.blade.phpファイルに渡す
        return view('index', compact('name', 'languages'));
    }
}
