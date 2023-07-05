<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $quantityCount = 1;

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }
    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', '1')->exists()) {
                // if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
                // {
                //     $this->dispatchBrowserEvent('message',[
                //         'text' => 'Sản phẩm đã được thêm',
                //         'type' => 'warning',
                //         'status' => 401
                //     ]);
                // }
                
                    $cartItem = Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->first();
                    if ($cartItem) {
                        $newQuantity = $cartItem->quantity + $this->quantityCount;
                        if ($newQuantity > $this->product->quantity) {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Không thể thêm sản phẩm, vì số lượng mặt hàng không đủ!',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        } else {
                            $cartItem->quantity = $newQuantity;
                            $cartItem->save();
                            $this->emit('CartAddedUpdated');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Số lượng sản phẩm trong giỏ hàng đã được cập nhật',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        }
                    } else {
                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity >= $this->quantityCount) {

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
    
    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
