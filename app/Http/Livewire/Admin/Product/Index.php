<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $product_id;
    public $categoryId, $category,$searchTerm;
    protected $products;
    // public function mount($products, $category)
    // {
    //     $this->products = $products;
    //     $this->category = $category;
    // }
    
    public function render()
    {
        $categories = Category::all();
    
        $query = Product::query();
        
        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }
        
        if ($this->searchTerm) {
            $query->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('id', 'like', '%'.$this->searchTerm.'%');
        }
        
        // $this->products = $query->get();
        $this->products = $query->paginate(5);
        return view('livewire.admin.product.index',compact('categories'))
        ->with('products', $this->products);

          // $products = Product::orderBy('id', 'ASC')->paginate(3);
    }
    public function filter()
    {
        $this->validate([
            'categoryId' => 'nullable|exists:categories,id',
        ]);
    }
    public function deleteProduct($product_id)
    {
        $this->product_id = $product_id;
    }


    public function destroyProduct()
    {
        $product = Product::findOrFail($this->product_id);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }

        $product->delete();
        return redirect()->back()->with('message', 'Xoá thành công sản phẩm');
    }

}
