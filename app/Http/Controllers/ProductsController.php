<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Products::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'categoryId' => 'required|integer',
            'description' => 'required|string|max:255',
            'sku' => 'required|string|max:30',
            // 'image' => 'required|string',
            'brand' => 'required|string|max:30',
            'tags' => 'required|string|max:255',

        ]);

        if ($request->hasFile('image')) {
            //! save image to public/images
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/ProductImages');
            $image->move($destinationPath, $name);
            $data['image'] = $_SERVER['SERVER_NAME'].'/ProductImages/'.$name;

            //! Using the Storage facade
            // $data['image'] = $_SERVER['SERVER_NAME'].'/storage/'.$request->image->store('public/products');
        }

        $product = Products::create($data);
        return response()->json(
            [
                'product' => $product,
                'category' => $product->category()->first()
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);
        if ($product) {
            return response()->json(
                [
                    'product' => $product,
                    'category' => $product->category()->first()
                ],
                200
            );
        }
        return response()->json(['message' => 'Not Found']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'categoryId' => 'required|integer',
            'description' => 'required|string|max:255',
            'sku' => 'required|string|max:30',
            // 'image' => 'required|string',
            'brand' => 'required|string|max:30',
            'tags' => 'required|string|max:255',

        ]);

        if ($request->hasFile('image')) {
            //! save image to public/images
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/ProductImages');
            $image->move($destinationPath, $name);
            $data['image'] = $_SERVER['SERVER_NAME'].'/ProductImages/'.$name;

            //! using the Storage facade
            // $data['image'] = $request->image->store('public/products');
        }

        $product = Products::find($id);
        if ($product) {
            $product->update($data);
            return response()->json(
                [
                    'product' => $product,
                    'category' => $product->category()->first()
                ],
                200
            );
        }
        return response()->json(['message' => 'Not Found']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Products::destroy($id))
            return response()->json(['message' => 'Product deleted successfully']);
        return response()->json(['message' => 'Not Found']);
    }
}
