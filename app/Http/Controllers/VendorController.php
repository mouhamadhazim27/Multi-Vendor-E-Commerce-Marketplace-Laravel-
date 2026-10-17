<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use App\Models\Products;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function vendorDashboard()
    {
        $store = Store::where('user_id', Auth::user()->id)
            ->withCount('products')
            ->first();

        return view('vendors.dashboard', compact('store'));
    }

    public function vendorProducts()
    {
        $categories = Categories::all();
        return view('vendors.products', compact('categories'));
    }

    public function addProduct(Request $request)
    {
        $fields = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity_in_stock' => ['required', 'integer', 'min:0'],
            'image_product' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

        ]);

        // ensure vendor has an associated store
        $fields['store_id'] = $request->user()->store->id;
        $image_name = time() . '_' . $request->file('image_product')->extension();
        $request->file('image_product')->move(public_path('assets/images/products'), $image_name);
        $fields['image_product'] = $image_name;

        $products = Products::create($fields);
        return redirect()->back()->with('success', 'Product added successfully');
    }

    public function viewStoreProd()
    {
        $stores = Store::where('user_id', Auth::user()->id)->first();
        $products = Products::where('store_id', $stores->id)->get();
        return view('vendors.mystore', compact('products'));
    }

    public function editProductPage(Products $products)
    {
        if (Auth::user()->id === $products->store->user_id) {
            $products_categories = $products->categories()->pluck('category_id');
            $categories = Categories::whereNotIn('id', $products_categories)->get();
            return view('vendors.editproduct', compact('products', 'categories'));
        } else {
            abort(403, 'Rouh zamer');
        }
    }

    function addProductCat(Request $request, Products $products)
    {
        $fields = $request->validate([
            'category_id' => ['required', 'int', 'exists:categories,id'],
        ]);

        if ($products->categories()->count() >= 3) {
            return redirect()->back()->with('error', 'A product can have maximum 3 categories.');
        }

        if (!$products->categories->contains($fields['category_id'])) {
            $products->categories()->attach($fields['category_id']);
        }

        return redirect()->back();
    }

    public function editProductAction(Products $products, Request $request)
    {
        $fields = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'between:1,255'],
            'price' => ['required', 'integer', 'min:0'],
            'quantity_in_stock' => ['required', 'integer', 'min:0'],
            'image_product' => ['image', 'max:2048', 'mimes:jpeg,png,gif,jpg'],
        ]);

        if (isset($fields['image_product'])) {
            $image_name = time() . '.' . $fields['image_product']->extension();
            $fields['image_product']->move(public_path('assets/images/products'), $image_name);
            $fields['image_product'] = $image_name;
        } else {
            $fields['image_product'] = $products->image_product;
        }

        $products->update($fields);
        return redirect()->back();
    }

    public function deleteProductAction($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect()->back();
    }

    public function viewOrdersVendors()
    {
        $storeId = Auth::user()->store->id;

        $orders = Order::whereHas('items.product', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })
            ->with(['items' => function ($q) use ($storeId) {
                $q->whereHas('product', function ($q2) use ($storeId) {
                    $q2->where('store_id', $storeId);
                })->with('product');
            }])
            ->get();

        return view('vendors.orders', compact('orders'));
    }
}
