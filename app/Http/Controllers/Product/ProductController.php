<?php

namespace App\Http\Controllers\Product;


use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Reply;
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
        $userId=Auth::id();
        $products = Product::where("product_see_type", 0)
            ->orWhere(function($query) use ($userId) {
                $query->where("product_see_type", 1)
                    ->whereJsonContains("product_see_users",(int)$userId);  // Burada JSON içərisində istifadəçi ID-ni yoxlayaq
            })
            ->orWhere(function($query) use ($userId) {
                $query->whereNull("user_id") // user_id boşdursa da göstər
                ->orWhere("user_id", $userId);
            })
            ->get();


//        dd($products->pluck('id', 'user_id'));



//        dd( $products);
        return view('products.index', compact('products'));
    }


    // Yeni məhsul yaratmaq üçün forma
    public function create()
    {
        $categories = Category::all(); // Kateqoriyalar
        $suppliers = Supplier::all(); // Müştərilər
        $units = Unit::all(); // Vahidlər
        $product = Product::all();
        $users = User::all();


        return view('products.create', compact('categories', 'suppliers', 'units','users', 'product'));
    }

    // Yeni məhsulun yaradılması
     public function store(StoreProductRequest $request)
    {

        $validated = $request->validated();
        $authUser = Auth::user();

        // Seçilmiş istifadəçiləri json formatında saxlayırıq
        $selectedUsers = $request->input('user_ids', []);  // Seçilmiş istifadəçilər
        $validated['product_see_users'] = count($selectedUsers) == 1 ? (int) $selectedUsers[0] : json_encode($selectedUsers);

        // Məhsul yaradılır
        $product = Product::create($validated);

        // Məhsul şəkili varsa, onu yükləyirik
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products/', $filename, 'public');
            $product->update(['product_image' => $filename]);
        }

        // Seçilmiş istifadəçilərə bildiriş göndəririk
        if ($authUser && $authUser->id == 1 && !empty($selectedUsers)) {
            // Seçilmiş istifadəçilərə bildiriş göndəririk
            Notification::send(User::whereIn('id', $selectedUsers)->get(), new GeneralNotification([
                'title' => 'Yeni məhsul yaradıldı',
                'text' => 'Sizin üçün yeni bir məhsul yaradıldı: ' . $product->name,
                'product_name' => $product->name,
                'url' => '/products/' . $product->id
            ]));
        }
        return redirect()->route('products.index')->with('success', 'Məhsul uğurla yaradıldı!');
    }

    // Məhsulun ətraflı məlumatını göstərir
    public function show(Product $product)
    {
        $replies = $product->replies()->with('user', 'children.user')->get();


        return view('products.show', compact('product','replies'));
    }
    public function storeReply(Request $request, Product $product)
    {
        // Burada reply-ni alıb işləyin
        $validated = $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        // Şərh əlavə etmək üçün kod
        $product->replies()->create([
            'content' => $validated['reply'],
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'parent_id' => $request->input('parent_id')
        ]);

        return redirect()->route('products.show', $product->id)->with('success', 'Cavab uğurla əlavə edildi.');
    }
// Cavabın altına cavab əlavə etmək (storeReply) metodu



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
