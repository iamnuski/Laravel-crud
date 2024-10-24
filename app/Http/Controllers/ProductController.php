<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// Import the Product model
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('product.index', ['products' => $products]);
    }
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'description' => 'required', // fixed lowercase 'description'
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required|image', // Ensures it's an image file
        ]);

        $imageName = time() . "." . $request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        $product = new Product();
        $product->name = $request->name;
        $product->image = $imageName;
        $product->description = $request->description;
        $product->mrp = $request->mrp;
        $product->price = $request->price;
        $product->save();
        return back()->withSuccess('Product Details Added Success...');

    }
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return view('product.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('product.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        $product = Product::where('id', $id)->first();

        if (isset($request->image)) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }
        $product->description = $request->description;
        $product->mrp = $request->mrp;
        $product->price = $request->price;
        $product->save();
        return back()->withSuccess('Product Details Updated Success...');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return back()->withSuccess('Product Details Deleted Success...');
    }

}
