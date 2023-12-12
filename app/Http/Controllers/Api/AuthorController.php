<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/authors",
     *     summary="List authors",
     *     description="Returns the complete author list from the table 'authors' ",
     *     @OA\Response(
     *         response=200,
     *         description="List of authors",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer",example="1"),
     *                 @OA\Property(property="nombres", type="string",example="Joyanes Aguilar, Luis"),
     *                 @OA\Property(property="created_at", type="string", example="2023-10-11T07:26:20.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", example="2023-10-11T07:26:22.000000Z"),
     *             ),
     *         ),
     * 
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Something went wrong",
     *     )
     * )
     */
    public function index()
    {
        //
        $authors = Author::all();
        return $authors;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $author = new Author();
        $author->nombres = $request->nombres;
        $author->save();
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/author/{id}",
     *     summary="get author details",
     *     description="Returns the complete author detaild based on Id ",
     *     @OA\Response(
     *         response=200,
     *         description="
     *         Detail of author
     *         ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer",example="1"),
     *                 @OA\Property(property="nombres", type="string",example="Joyanes Aguilar, Luis"),
     *                 @OA\Property(property="created_at", type="string", example="2023-10-11T07:26:20.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", example="2023-10-11T07:26:22.000000Z"),
     *             ),
     *         ),
     * 
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Something went wrong",
     *     )
     * )
     */
    public function show(string $id)
    {
        //
        $author = Author::find($id);
        return $author;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $author = Author::findOrFail($id);
        $author->nombres = $request->nombres;
        $author->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Author::destroy($id);
    }
}
