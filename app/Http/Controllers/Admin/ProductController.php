<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.products.index')->with([
            'products' => Product::query()->with(['colors','sizes'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.products.create')->with([
            'colors' => Color::all(),
            'sizes' => Size::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        //
        if ($request->validated()) {
            $data = $request->all();
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            // Check if the admin upload first image
            if($request->has('first_image')){
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }
            // Check if the admin second first image
            if($request->has('second_image')){
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }
            // Check if the admin third first image
            if($request->has('third_image')){
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }
            // add the slug
            $data['slug'] = Str::slug($request->name);
            $product = Product::query()->create($data);
            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);
            return redirect()->route('admin.products.index')->with([
                'success' => 'Product has been added Successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view('admin.products.edit')->with([
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        if ($request->validated()) {
            $data = $request->all(); // remove '_token' and '_method' from request data
            if($request->has('thumbnail')){
                // remove the old thumbnail
                $this->removeProductImageFromStorage($product->thumbnail);
                // store new thumbnail
                $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            }
            // Check if the admin upload first image
            if($request->has('first_image')){
                // remove the old first_image
                $this->removeProductImageFromStorage($product->first_image);
                // store new first_image
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }
            // Check if the admin second image
            if($request->has('second_image')){
                // remove the old second image
                $this->removeProductImageFromStorage($product->second_image);
                // store new second image
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }
            // Check if the admin third image
            if($request->has('third_image')){
                // remove the old third image
                $this->removeProductImageFromStorage($product->third_image);
                // store new third image
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }
            // add the slug
            $data['slug'] = Str::slug($request->name);
            $product->update($data);
            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);
            return redirect()->route('admin.products.index')->with([
                'success' => 'Product has been updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // remove the product images
        $this->removeProductImageFromStorage($product->thumbnail);
        $this->removeProductImageFromStorage($product->first_image);
        $this->removeProductImageFromStorage($product->second_image);
        $this->removeProductImageFromStorage($product->third_image);
        // delete the product
        $product->delete();
        return redirect()->route('admin.products.index')->with([
            'success' => 'Product has been deleted Successfully'
        ]);
    }



    // Remove products images from storage
    private function removeProductImageFromStorage($file)
    {
        $path = public_path($file);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    // Save images in the storage
    public function saveImage($file)
    {
        $image_name = time().'_'.$file->getClientOriginalName();
        $file->storeAs('images/products/', $image_name, 'public');
        return 'storage/images/products/'.$image_name;
    }
}
