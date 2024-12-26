<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Lấy danh sách tất cả các danh mục
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:500',
        ]);

        // Lưu danh mục mới vào cơ sở dữ liệu
        Category::create($request->all());

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        
        // Nếu không tìm thấy danh mục, trả về lỗi 404
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Danh mục không tồn tại');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:500',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Danh mục không tồn tại');
        }

        // Cập nhật thông tin danh mục
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Danh mục không tồn tại');
        }

        // Xóa danh mục
        $category->delete();

        return redirect()->route('categories.index');
    }

    public function show()
{
    // Lấy tất cả danh mục từ cơ sở dữ liệu
    $categories = Category::all();
    // dd($categories);
    // Trả về view 'home' và truyền danh mục vào view
    return view('home', compact('categories'));
}

}
