<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Trending extends Component
{
    public $products, $priceInput, $quantityCount = 1;
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
        ->where('trending', '1')
        ->take(20)->get();


        return view('livewire.frontend.product.trending', [
            'products' => $this->products,

        ]);
    }
}
