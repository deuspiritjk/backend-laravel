<?php



namespace App\Http\Controllers\Api;

use App\Models\Book;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="List books",
     *     description="Returns the complete product list from the table 'books' ",
     *     @OA\Response(
     *         response=200,
     *         description="List of books",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer",example="1"),
     *                 @OA\Property(property="isbn", type="string", example="23-1794-01"),
     *                 @OA\Property(property="titulo", type="string",example="The nice book for sleep"),
     *                 @OA\Property(property="year", type="integer", example="2099"),
     *                 @OA\Property(property="precio", type="number", format="decimal", example="3.99"),
     *                 @OA\Property(property="cantidad", type="integer", example="2"),
     *                 @OA\Property(property="created_at", type="string", example="2023-10-11T07:26:20.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", example="2023-10-11T07:26:22.000000Z"),
     *                 @OA\Property(property="editorial_id", type="integer", example="2"),
     *                 @OA\Property(property="author_id", type="integer",example="3")
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
        $books = Book::all();
        return $books;
    }
    public function query(Request $request){
        $input = $request->all();
        $books = Book::orderBy( array_key_exists("orderBy", $input) ? $input['orderBy'] : 'id','asc')
        ->take( array_key_exists("limit", $input) ? $input['limit'] : POSIX_RLIMIT_INFINITY)->get();

        return response()->json([
            'data'=>$books
        ]);
    }
    public function store(Request $request)
    {
        //
        $book = new Book();
        $book->isbn = $request->isbn;
        $book->titulo = $request->titulo;
        $book->year = $request->year;
        $book->precio = $request->precio;
        $book->cantidad = $request->cantidad;
        $book->editorial_id = $request->editorial_id;
        $book->author_id = $request->author_id;

        $book->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = Book::find($id);
        return $book;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
       $book = Book::findOrFail($id);
        $book->isbn = $request->isbn();
        $book->titulo = $request->titulo();
        $book->year = $request->year();
        $book->precio = $request->precio();
        $book->cantidad = $request->cantidad();
        $book->editorial_id = $request->editorial_id();
        $book->author_id = $request->author_id();

        $book->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Book::destroy($id);
    }
}
