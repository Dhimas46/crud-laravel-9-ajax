<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
       $products = Product::all();
       return response()->json([
         'products' => $products
       ]);
       // $products = Product::latest()->paginate(5);
       // return view('products.get', compact('products'));
    }

    public function details($id)
    {
        $data = Product::find($id);

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Products not found'], 404);
        }
    }

    public function store(Request $request)
      {
          // validate request data
          $validatedData = $request->validate([
              'name' => 'required|string',
              'quantity' => 'required|integer|min:0',
              'harga' => 'required|numeric|min:0'
          ]);

          // create new product
          $product = new Product;
          $product->name = $validatedData['name'];
          $product->quantity = $validatedData['quantity'];
          $product->harga = $validatedData['harga'];

          if (!$product->save()) {
              return response()->json(['error' => 'Failed to save product.'], 500);
          }
          return response()->json([
              'success' => true,
              'message' => 'Product added successfully!',
              'product' => $product
          ], 200);
      }
      public function edit($id)
      {
        $product = Product::findOrFail($id);
        return response()->json($product);
      }

      public function update(Request $request)
      {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0'
        ]);
          $product = Product::findOrFail($request->id);
          $product->name = $request->name;
          $product->quantity = $request->quantity;
          $product->harga = $request->harga;
          $product->save();
          if (!$product->save()) {
              return response()->json(['error' => 'Failed to save product.'], 500);
          }
          return response()->json([
              'success' => true,
              'message' => 'Product update successfully!',
              'product' => $product
          ], 200);
      }

      public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
          'message' => 'Data berhasil dihapus!',
          'success' => true,
        ], 200);
    }



}
