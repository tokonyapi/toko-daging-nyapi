<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        $categories = ['cube', 'slice', 'premium'];
        return view('admin.admin_add_product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:cube,slice,premium',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'stock' => 'required|integer',
            'berat' => 'required|integer',
            'price' => 'required|numeric',
            'slug' => 'required|unique:products,slug',
        ]);

        $data = Product::create($request->all());

        if ($request->file('image')) {
            $request->file('image')->move('img-product/', $request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }

        return redirect()->back()->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = ['cube', 'slice', 'premium'];
        return view('admin.admin_edit_product', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category' => 'required|in:cube,slice,premium',
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'stock' => 'required|integer',
            'berat' => 'required|integer',
            'price' => 'required|numeric',
            'slug' => 'required|unique:products,slug,' . $product->id,
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('img-product/' . $product->image);
            }
            $request->file('image')->move('img-product/', $request->file('image')->getClientOriginalName());
            $data['image'] = $request->file('image')->getClientOriginalName();
        }

        

        $product->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete('img-product/' . $product->image);
        }
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }

    public function index()
    {
        $products = Product::all();
        return view('user.product', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('user.detail_product', compact('product'));
    }
}
