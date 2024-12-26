<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;


class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('contactUs.contact', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^[0-9]{10,15}$/',
            'message' => 'required',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Thank you for contacting us!');
    }
    public function show()
{
    // Lấy tất cả các contact từ database
    $contacts = Contact::all();

    // Trả về view hiển thị danh sách
    return view('contactUs.show', compact('contacts'));
}
public function detail($id)
{
    $contact = Contact::findOrFail($id);
    return view('contactUs.detail', compact('contact'));
}
public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->route('contacts.show')->with('success', 'Liên hệ đã được xóa thành công!');
}


}

