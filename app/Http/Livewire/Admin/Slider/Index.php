<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $sliders, $paginationTheme = 'bootstrap';
    public $slider_id,$searchKey;
    public function render()
    {
        $query = Slider::query();
        
        if ($this->searchKey) {
            $query->where('title', 'like', '%'.$this->searchKey.'%')
            ->orWhere('id', 'like', '%'.$this->searchKey.'%');
        }
        
        $this->sliders = $query->paginate(3);
        return view('livewire.admin.slider.index' )->with('sliders', $this->sliders);

        // $sliders = Slider::orderBy('id', 'DESC')->paginate(3);
        // return view('livewire.admin.slider.index', compact('sliders'));
    }
    
    public function deleteSlider($slider_id)
    {
        $this->slider_id = $slider_id;
    }

    public function destroySlider()
    {
        $slider = Slider::find($this->slider_id);
        $path = $slider->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $slider->delete();
        session()->flash('message', 'Xoá ảnh thanh trượt thành công');
    }

 
}
