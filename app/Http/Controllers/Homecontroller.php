<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Homecontroller extends Controller
{
    public function index():View
    {
        $products = Product::limit(3)->get();
        return view('pages.home',compact('products'));
    }
}
