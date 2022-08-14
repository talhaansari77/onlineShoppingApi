<?php

namespace App\Http\Controllers;

use App\Models\ProductVariants;
use Illuminate\Http\Request;

class ProductVariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductVariants::all();
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
            'name' => 'required|string|max:50',
            'stock' => 'required|integer',
            'salePrice' => 'required|numeric',
            'costPrice' => 'required|numeric',
            'saleCount' => 'required|integer',
            'rating' => 'required|numeric',
            'new' => 'required|string',
            'colorId' => 'required|integer',
            'sizeId' => 'required|integer',
            'discountId' => 'required|integer',
            'productId' => 'required|integer',        
        ]);
        $productVariant = ProductVariants::create($data);
        return response()->json(
            [
                'productVariant' => $productVariant,
                'product' => $productVariant->product()->first(),
                'variant' => [
                    'color' =>$productVariant->color()->first(),
                    'size' =>$productVariant->size()->first(),
                    'discount' =>$productVariant->discount()->first()
                    ]
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
        $productVariant = ProductVariants::find($id);
        if ($productVariant)
        return response()->json(
            [
                'productVariant' => $productVariant,
                'product' => $productVariant->product()->first(),
                'variant' => [
                    'color' =>$productVariant->color()->first(),
                    'size' =>$productVariant->size()->first(),
                    'discount' =>$productVariant->discount()->first()
                    ]
            ],
            200
        );
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
            'name' => 'required|string|max:50',
            'stock' => 'required|integer',
            'salePrice' => 'required|numeric',
            'costPrice' => 'required|numeric',
            'saleCount' => 'required|integer',
            'rating' => 'required|numeric',
            'new' => 'required|string',
            'colorId' => 'required|integer',
            'sizeId' => 'required|integer',
            'discountId' => 'required|integer',
            'productId' => 'required|integer',        
        ]);
        $productVariant = ProductVariants::find($id);
        if ($productVariant) {
            $productVariant->update($data);
            return response()->json(
                [
                    'productVariant' => $productVariant,
                    'product' => $productVariant->product()->first(),
                    'variant' => [
                        'color' =>$productVariant->color()->first(),
                        'size' =>$productVariant->size()->first(),
                        'discount' =>$productVariant->discount()->first()
                        ]
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
        if (ProductVariants::destroy($id))
            return response()->json(['message' => 'ProductVariant deleted successfully']);
        return response()->json(['message' => 'Not Found']);
    }
}
