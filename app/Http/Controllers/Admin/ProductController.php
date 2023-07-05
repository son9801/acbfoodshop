<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' =>  $request->trending == true ? '1' : '0',
            'status' =>  $request->status == true ? '1' : '0',
            // 'meta_title' => $validatedData['meta_title'],
            // 'meta_keyword' => $validatedData['meta_keyword'],
            // 'meta_description' => $validatedData['meta_description'],
        ]);


        if ($request->hasFile('image')) {

            $uploadPath = 'uploads/product/';

            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        return redirect('admin/product')->with('message', 'Thêm thành công sản phẩm mới');
    }

    public function edit(int $product_id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($product_id);
        return view('admin.product.edit', compact('categories', 'product'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();

        $product = Product::where('id', $product_id)->first();
        // $product = Category::findOrFail($validatedData['category_id'])->products()->where('id', $product_id)->first();

        if ($product) {
            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' =>  $request->trending == true ? '1' : '0',
                'status' =>  $request->status == true ? '1' : '0',
                // 'meta_title' => $validatedData['meta_title'],
                // 'meta_keyword' => $validatedData['meta_keyword'],
                // 'meta_description' => $validatedData['meta_description'],
            ]);

            if ($request->hasFile('image')) {

                $uploadPath = 'uploads/product/';

                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath . $filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }

            return redirect('admin/product')->with('message', 'Sửa thành công sản phẩm');
        } else {
            return redirect('admin/product')->with('message', 'Ko co');
        }
    }

    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Đã xoá ảnh');
    }

    // public function delete(int $product_id)
    // {
    //     $product = Product::findOrFail($product_id);
    //     if ($product->productImages) {
    //         foreach ($product->productImages as $image) {
    //             if (File::exists($image->image)) {
    //                 File::delete($image->image);
    //             }
    //         }
    //     }

    //     $product->delete();
    //     return redirect()->back()->with('message', 'Xoá thành công sản phẩm');
    // }


}
