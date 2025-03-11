<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Notifications\GeneralNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorHTML;

class ProductController extends Controller
{
    // Məhsulların siyahısını göstərir
    public function index()
    {
        $products = Product::all(); // Bütün məhsulları alır
        return view('products.index', compact('products'));
    }

    // Yeni məhsul yaratmaq üçün forma
    public function create()
    {
        $categories = Category::all(); // Kateqoriyalar
        $suppliers = Supplier::all(); // Müştərilər
        $units = Unit::all(); // Vahidlər
        $product = Product::all();

        return view('products.create', compact('categories', 'suppliers', 'units', 'product'));
    }

    // Yeni məhsulun yaradılması
     public function store(StoreProductRequest $request)

    {

        // Validasiya nəticəsində verilən məlumatları alırıq
         $validated = $request->validated();

        // Yeni məhsulu yaradın
         $product = Product::create($validated);

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products/', $filename, 'public');

            // Məhsulu yeniləyin və şəkil adını qeyd edin
            $product->update(['product_image' => $filename]);
        }
        $authUser=Auth::user(1);
        $user = User::find(1);  // Yalnız user 1-ə bildiriş göndəririk
        if ($user) {
            Notification::send($user, new GeneralNotification([
                'title' => 'Məhsul məlumatları yeniləndi',
                'text' => $authUser->name . ' tərəfindən məhsul məlumatları yeniləndi',
                'product_name' => $product->name,
                'url' => '/products'
            ]));
        }
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    // Məhsulun ətraflı məlumatını göstərir
    public function show(Product $product)
    {
        // Məhsul üçün barkod yaradılır
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($product->code, $generator::TYPE_CODE_128);

        return view('products.show', compact('product', 'barcode'));
    }

    // Məhsulun məlumatlarını yeniləmək üçün forma
    public function edit(Product $product)
    {
//        dd(route('products.update', $product->id));
        $categories = Category::all(); // Kateqoriyalar
        $customers = Customer::all(); // Müştərilər
        $units = Unit::all(); // Vahidlər
        $suppliers = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'customers', 'suppliers','units'));
    }

//     Məhsul məlumatlarını yeniləyir
    public function update(UpdateProductRequest $request, $id)
//    public function update(Request $request, $id)
{
//        dd($request->all());
        // Validasiya nəticəsində verilən məlumatları alırıq
        $validated = $request->validated();
        $product=Product::findOrFail($id);
        $product->update($validated);

        $authUser=Auth::user();
        $authUser = Auth::user();
        if ($authUser && $authUser->id == 1) {
            Notification::send($authUser, new GeneralNotification([
                'title' => 'Məhsul məlumatları yeniləndi',
                'text' => $authUser->name . ' tərəfindən məhsul məlumatları yeniləndi',
                'product_name' => $product->name,
                'url' => '/products'
            ]));
        }


//        // Şəkil varsa, onu yeniləyin
        if ($request->hasFile('product_image')) {
            // Köhnə şəkil varsa, onu silin
            if ($product->product_image) {
                unlink(public_path('storage/products/') . $product->product_image);
            }

            // Yeni şəkili yükləyin
            $file = $request->file('product_image');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products/', $filename, 'public');

            // Məhsulu yeniləyin və yeni şəkil adını qeyd edin
            $product->update(['product_image' => $filename]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Məhsulu silir
    public function destroy(Product $product)
    {
        // Məhsulun şəkili varsa, onu silin
        if ($product->product_image) {
            unlink(public_path('storage/products/') . $product->product_image);
        }

        // Məhsul məlumatını silirik
        $product->delete();
        $user = User::find(1);  // Sadəcə user 1-ə bildiriş göndəririk
        if ($user) {
            Notification::send($user, new GeneralNotification([
                'title' => 'Məhsul silindi',
                'text' => $user->name . ' tərəfindən məhsul silindi',
                'product_name' => $product->name,
                'url' => '/products'
            ]));
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
