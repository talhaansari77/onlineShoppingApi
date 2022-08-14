<?php

namespace App\Http\Controllers;

use App\Models\Discounts;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Discounts::all();
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
            'discountPrice' => 'required|string',
        ]);
        $discounts = Discounts::create($data);
        return $discounts;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Discounts::find($id))
            return Discounts::find($id);
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
            'discountPrice' => 'required|string',
        ]);
        $discounts = Discounts::find($id);
        if ($discounts) {
            $discounts->update($data);
            return $discounts;
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
        if (Discounts::destroy($id))
            return response()->json(['message' => 'Discount deleted successfully']);
        return response()->json(['message' => 'Not Found']);
    }
}
