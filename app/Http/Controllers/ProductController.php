<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        $product = false;
        return view('admin.pages.products.view', compact('product'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('products', 'name')->whereNull('deleted_at'),
            ],
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable',
        ]);

        $data['slug'] = Str::slug($data['name']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $data['image'] = $this->storeProductImage($image, 'products');
        }
        $data['added_by'] = Auth::user()->id;
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('admin.pages.products.view', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('products', 'name')->ignore($product->id)->whereNull('deleted_at'),
            ],
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = $this->storeProductImage($image, 'products');
            Storage::delete($product->image);
        }
        $data['slug'] = Str::slug($data['name']);
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function storeProductImage(UploadedFile $image, $folder = 'products')
    {
        $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $filePath = $folder . '/' . $fileName;

        Storage::disk('public')->put($filePath, file_get_contents($image));

        return $filePath;
    }
}
