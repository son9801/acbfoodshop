<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class FrontendController extends Controller
{
    public $products, $quantityCount = 1;
    public function index()
    {
        $saleProducts = Product::whereColumn('selling_price', '<', 'original_price')->get();
        $newArrivalsProducts = Product::latest()->take(16)->get();
        $sliders = Slider::where('status', '1')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(11)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivalsProducts', 'saleProducts'));
    }

    // public function addToCart(Request $request)
    // {
    //     $productId = $request->input('productId');
    //     if (Auth::check()) {
    //         if (Product::where('id', $productId)->where('status', '1')->first()) {
    //             $cartItem = Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->first();
    //             if ($cartItem) {
    //                 $this->products = Product::find($productId);
    //                 $newQuantity = $cartItem->quantity + $this->quantityCount;
    //                 if ($newQuantity > $this->products->quantity) {
    //                     $this->dispatchBrowserEvent('message', [
    //                         'text' => 'Hết hàng',
    //                         'type' => 'warning',
    //                         'status' => 404
    //                     ]);
    //                 } else {
    //                     $cartItem->quantity = $newQuantity;
    //                     $cartItem->save();
    //                     $dispatcher = new Dispatcher();
    //                     $dispatcher->dispatch('CartAddedUpdate', [$cartItem]);
    //                     // $this->emit('CartAddedUpdated');
    //                     Event::dispatch('message', [
    //                         'text' => 'Đã thêm sản phẩm vào giỏ hàng',
    //                         'type' => 'success',
    //                         'status' => 200
    //                     ]);
    //                 }
    //             } else {
    //                 $this->products = Product::find($productId);
    //                 if ($this->products->quantity > 0) {
    //                     if ($this->products->quantity > $this->quantityCount) {

    //                         //inser product to cart
    //                         Cart::create([
    //                             'user_id' => auth()->user()->id,
    //                             'product_id' => $productId,
    //                             'quantity' => $this->quantityCount
    //                         ]);
    //                         $dispatcher = new Dispatcher();
    //                         // $dispatcher->dispatch('CartAddedUpdate', [$cartItem]);
    //                         // $this->emit('CartAddedUpdated');
    //                         window.WebSocket('message', [
    //                             'text' => 'Thêm vào giỏ thành công',
    //                             'type' => 'success',
    //                             'status' => 200
    //                         ]);
    //                     } else {
    //                         $this->dispatchBrowserEvent('message', [
    //                             'text' => 'Mặt hàng này còn' . $this->products->quantity . ' sản phẩm',
    //                             'type' => 'warning',
    //                             'status' => 404
    //                         ]);
    //                     }
    //                 } else {
    //                     $this->dispatchBrowserEvent('message', [
    //                         'text' => 'Sản phẩm đã hết',
    //                         'type' => 'warning',
    //                         'status' => 401
    //                     ]);
    //                 }
    //             }
    //         } else {
    //             $this->dispatchBrowserEvent('message', [
    //                 'text' => 'Sản phẩm này không tồn tại',
    //                 'type' => 'error',
    //                 'status' => 401
    //             ]);
    //         }
    //     } else {
    //         $this->dispatchBrowserEvent('message', [
    //             'text' => 'Đăng nhập để thêm vào giỏ',
    //             'type' => 'warning',
    //             'status' => 401
    //         ]);
    //     }
    // }
    public function searchProducts(Request $request)
    {
        if ($request->search) {
            $searchProducts = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
            return view('frontend.pages.search', compact('searchProducts'));
        } else {
            return redirect()->back()->with('message', 'Trống');
        }
    }


    public function sale()
    {
        $saleProducts = Product::whereColumn('selling_price', '<', 'original_price')->get();
        return view('frontend.pages.sale', compact('saleProducts'));
    }

    public function categories()
    {
        $categories = Category::where('status', '1')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            return view('frontend.collections.products.index', compact('category'));
        } else {
            return redirect()->back();
        }
    }

    public function saleProducts()
    {
            return view('frontend.pages.sale');
   
    }
    // product view
    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->where('status', '1')->first();
            if ($product) {
                return view('frontend.collections.products.view', compact('product', 'category'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function newArrival()
    {
        return view('frontend.pages.new-arrival');
    }
    public function trending()
    {
        return view('frontend.pages.trending');
    }


    public function thankyou()
    {
        return view('frontend.thankyou');
    }
}
