<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        // Lấy 4 sản phẩm đầu tiên
        $products = Product::take(4)->get();
        return view('home', compact('categories','products'));
    }

    public function show($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($id);
        $categories = Category::all();


        // Trả về view và gửi dữ liệu sản phẩm
        return view('products.show', compact('product','categories'));
    }
    
    // Phương thức hiển thị các sản phẩm cho trang /home/products
    public function products()
    {
        $categories = Category::all();
        $products = Product::all();

        return view('home.products', compact('categories', 'products'));
    }
    

}
