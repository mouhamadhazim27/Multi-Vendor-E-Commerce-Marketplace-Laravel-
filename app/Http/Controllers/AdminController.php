<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Categories;
use App\Models\PaymentModel;
use App\Models\Products;
use App\Models\Store;
use App\Models\User;
use App\Notifications\AcceptNotification;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function carouselsAdminPage()
    {
        $slides = Carousel::paginate(1);
        return view('admin.carousels', compact('slides'));
    }

    public function deleteCarousel($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();
        return redirect()->back()->with('success', 'Carousel slide deleted successfully.');
    }

    public function storeCarousel(Request $request)
    {
        $fields = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $image_name = time() . '_' . $fields['image']->extension();
        $fields['image']->move(public_path('assets/images/carousels'), $image_name);
        $fields['image'] = $image_name;

        Carousel::create($fields);

        return redirect()->back()->with('success', 'Carousel slide added successfully.');
    }

    public function usersAdminPage()
    {
        $users = User::oldest()->paginate(6);
        return view('admin.users',  compact('users'));
    }
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', $user->name . ' deleted successfully.');
    }

    public function updateUserRole(Request $request, $id)
    {
        $fields = $request->validate([
            'role' => ['required', 'in:customer,vendor,admin'],
        ]);

        $user = User::findOrFail($id);
        $user->role = $fields['role'];
        $user->save();

        return redirect()->route('admin.users')->with('success', $user->name . ' role updated to ' . $user->role . ' successfully.');
    }

    public function deletedUsers()
    {
        $users = User::onlyTrashed()->oldest()->paginate(8);
        return view('admin.deleted-users', compact('users'));
    }
    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->back()->with('success', $user->name . ' restored successfully.');
    }

    public function filterUsersByRole($role)
    {
        $users = User::where('role', $role)->oldest()->paginate(8);
        return view('admin.users', compact('users'));
    }

    public function storesAdminPage()
    {
        $stores = Store::latest()->paginate(8);
        return view('admin.stores', compact('stores'));
    }

    public function storesApprove($id)
    {
        $store = Store::findOrFail($id);
        $store->in_progress = 'Approved';

        if ($store->save()) {
            $store->user->role = 'vendor';
            $store->user->save();
        }

        $store->user->notify(new AcceptNotification($store));

        return redirect()->route('admin.stores.requests')->with('success', $store->store_name . ' approved successfully.');
    }

    public function storesDecline($id)
    {
        $store = Store::findOrFail($id);
        $store->in_progress = 'Declined';
        $store->save();

        return redirect()->route('admin.stores.requests')->with('success', $store->store_name . ' declined successfully.');
    }

    public function vendorsAdminPage()
    {
        $stores = Store::whereHas('user', function ($query) {
            $query->where('role', 'vendor');
        })->latest()->paginate(5);
        return view('admin.vendors', compact('stores'));
    }

    public function categories()
    {
        $categories = Categories::latest()->paginate(5);
        return view('admin.categories', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $fields = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        if (Categories::where('category_name', $fields['category_name'])->exists()) {
            return redirect()->back()->withErrors(['category_name' => $fields['category_name'] . ' name already exists.']);
        }

        Categories::create($fields);

        return redirect()->back()->with('success', $fields['category_name'] . ' category added successfully.');
    }

    public function deleteCategory($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', $category->category_name . ' category deleted successfully.');
    }

    public function viewProductsVendor(Store $store)
    {
        $storeProducts = $store->products;
        return view('admin.viewProducts' , compact('store' , 'storeProducts'));
    }

    public function deleteProductsVendor($id){
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', $product->product_name . ' product deleted successfully.');
        
    }

    public function paymentMethod(){
        $paymentMethods = PaymentModel::latest()->paginate(5);
        return view('admin.paymentMethod', compact('paymentMethods'));
    }

    public function addPaymentMethod(Request $request)
    {
        $fields = $request->validate([
            'payment_method' => ['required' , 'string' , 'max:255'],
        ]);

         PaymentModel::create($fields);
         return redirect()->back()->with('success', $fields['payment_method'] . ' payment method added successfully.');

    }

  
}
