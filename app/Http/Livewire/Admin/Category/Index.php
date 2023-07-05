<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    
    use WithPagination;
    protected $categories,$paginationTheme = 'bootstrap';
    public $category_id,$searchKey;
    public function render()
    {
        
        $query = Category::query();
        if ($this->searchKey) {
            $query->where('name', 'like', '%'.$this->searchKey.'%')
            ->orWhere('id', 'like', '%'.$this->searchKey.'%');
        }
        
        $categories = $query->paginate(3);

        // $categories = Category::orderBy('id', 'DESC')->paginate(3);
        return view('livewire.admin.category.index', compact('categories'));
        // return view('livewire.admin.category.index' )->with('categories', $categories);
    }
    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }
   
    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        $path = $category->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete();

        
        session()->flash('message', 'Xoá danh mục thành công');
    }
    

}
