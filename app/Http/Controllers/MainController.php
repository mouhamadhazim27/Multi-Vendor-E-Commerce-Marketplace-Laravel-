<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home()
    {
        $slides = Carousel::all();
        $products = Products::inRandomOrder()->paginate(4);
        $categories = Categories::all();
        return view('main.home', compact('slides', 'products', 'categories'));
    }

    public function becomeVendor()
    {
        return view('main.become-vendor');
    }

    public function storeVendor(Request $request)
    {
        $fields = $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'store_slug' => ['required', 'string', 'max:255', 'unique:stores'],
            'business_email' => ['required', 'email', 'max:255'],
            'business_type' => ['required', 'in:individual,company'],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'store_logo' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png'],
            'store_description' => ['nullable', 'string'],
        ]);

        if ($request->user()->email !== $fields['business_email']) {
            return back()->withErrors(['business_email' => 'Business email must match your account email.'])->withInput();
        }

        $fields['user_id'] = $request->user()->id;

        if ($request->hasFile('store_logo') && $request->file('store_logo')->isValid()) {
            $image_name = time() . '_' . $request->file('store_logo')->extension();
            $request->file('store_logo')->move(public_path('assets/images/stores'), $image_name);
            $fields['store_logo'] = $image_name;
        }

        Store::create($fields);
        return redirect()->route('home')->with('success', 'Your vendor application has been submitted successfully. We will review it and get back to you soon.');
    }

    public function viewProduct(Products $products)
    {
        $similarProducts = $products->similarProducts();
        return view('main.viewProduct', compact('products', 'similarProducts'));
    }

    public function search(Request $request)
    {
        $output = '';
        $products = Products::where('product_name', 'LIKE', '%' . $request->search . '%')
            ->limit(10)
            ->get();

        foreach ($products as $product) {
            $output .=
                '
              <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex align-items-center">
                   <img style="width:100px" src=" ' . asset('assets/images/products/' . $product->image_product) . ' " class="me-2 rounded">
                <div>
                   <div class="fw-bold">' . $product->product_name . '</div>
                <small class="text-muted">$' . $product->price . '</small>
                </div>
                </div>
             </a> ';
        }

        return response($output);
    }

    
}
