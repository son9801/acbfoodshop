<?php

namespace App\Http\Livewire\Frontend\Pages;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NewArrivals extends Component
{
    public $products, $priceInput, $quantityCount = 1;

    protected $queryString = [
        'priceInput' => ['except' => '', 'as' => 'price']
    ];
  
    // public function mount($category)
    // {
    //     // $this->products = $product;
    //     $this->category = $category;
    //     // $this->dispatchBrowserEvent('addToCart', ['productId' => null]); // Khởi tạo sự kiện addToCart
    // }
    // protected $listeners = ['addToCart'];
    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->products->where('id', $productId)->where('status', '1')->first()) {
                $cartItem = Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->first();
                if ($cartItem) {
                    $this->products = Product::find($productId);
                    $newQuantity = $cartItem->quantity + $this->quantityCount;
                    if ($newQuantity > $this->products->quantity) {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Hết hàng',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    } else {
                        $cartItem->quantity = $newQuantity;
                        $cartItem->save();
                        $this->emit('CartAddedUpdated');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Đã thêm sản phẩm vào giỏ hàng',
                            'type' => 'success',
                            'status' => 200
                        ]);
                    }
                } else {
                    $this->products = Product::find($productId);
                    if ($this->products->quantity > 0) {
                        if ($this->products->quantity > $this->quantityCount) {

                            //inser product to cart
                            Cart::create([
                                'user_id' => auth()->user()->id,
                                'product_id' => $productId,
                                'quantity' => $this->quantityCount
                            ]);

                            $this->emit('CartAddedUpdated');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Thêm vào giỏ thành công',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Mặt hàng này còn' . $this->product->quantity . ' sản phẩm',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Sản phẩm đã hết',
                            'type' => 'warning',
                            'status' => 401
                        ]);
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Sản phẩm này không tồn tại',
                    'type' => 'error',
                    'status' => 401
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Đăng nhập để thêm vào giỏ',
                'type' => 'warning',
                'status' => 401
            ]);
        }
    }
    public function render()
    {
        $this->products = Product::when($this->priceInput, function ($q) {
            $q->when($this->priceInput == 'high-to-low', function ($q2) {
                $q2->orderBy('selling_price', 'DESC');
            })
                ->when($this->priceInput == 'low-to-high', function ($q2) {
                    $q2->orderBy('selling_price', 'ASC');
                });
        })
        ->where('status', '1')
        ->orderBy('created_at', 'DESC') // sắp xếp theo thời gian tạo mới nhất
        ->take(20)->get();


        return view('livewire.frontend.pages.new-arrivals', [
            'products' => $this->products,

        ]);
    }
}
