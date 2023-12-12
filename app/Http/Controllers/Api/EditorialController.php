<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $editorials = Editorial::all();
        return $editorials;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $editorial = new Editorial();
        $editorial->nombre = $request->nombre;
        $editorial->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $editorial = Editorial::find($id);
        return $editorial;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $editorial = Editorial::findOrFail($id);
        $editorial->nombre = $request->nombre;
        $editorial->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Editorial::destroy($id);
    }
}
