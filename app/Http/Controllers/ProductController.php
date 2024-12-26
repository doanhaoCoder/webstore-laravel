<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị tất cả sản phẩm
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('products.index', compact('products','categories'));
        // return view('home', compact('products'));
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('products.create', compact('categories'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            // Lưu ảnh vào thư mục public/images
            $imagePath = $request->file('image')->move(public_path('images'), $request->file('image')->getClientOriginalName());
            $imagePath = 'images/' . $request->file('image')->getClientOriginalName(); // Đường dẫn ảnh lưu trong thư mục public/images
        }

        // Lưu sản phẩm vào database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath ?? null,  // Lưu đường dẫn ảnh vào database
        ]);

        return redirect()->route('products.index');
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại');
        }

        return view('products.edit', compact('product', 'categories'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại');
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image) {
                unlink(public_path($product->image)); // Xóa ảnh cũ khỏi thư mục public/images
            }

            // Lưu ảnh mới vào thư mục public/images
            $imagePath = $request->file('image')->move(public_path('images'), $request->file('image')->getClientOriginalName());
            $imagePath = 'images/' . $request->file('image')->getClientOriginalName(); // Đường dẫn ảnh lưu trong thư mục public/images
        }

        // Cập nhật thông tin sản phẩm
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath ?? $product->image,  // Nếu không có ảnh mới, giữ ảnh cũ
        ]);

        return redirect()->route('products.index');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại');
        }

        // Xóa ảnh nếu có
        if ($product->image) {
            unlink(public_path($product->image)); // Xóa ảnh khỏi thư mục public/images
        }

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('products.index');
    }
}
