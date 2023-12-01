<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Books::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Books::create([
            'title' => $request->title,
            'author' => $request->author,
            'publish_date' => $request->publish_date
        ]);
        return response()->json([
            "message" => "Book successfully added."
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Books::findOrFail($id);

        if (!empty($book)) {
            return response()->json($book);
        } else {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (Books::where('id', $id)->exists()) {

            $book = Books::find($id);

            Books::where('id', $id)->update([
                'title' => is_null($request->title) ? $book->title : $request->title,
                'author' => is_null($request->author) ? $book->author : $request->author,
                'publish_date' => is_null($request->publish_date) ? $book->publish_date : $request->publish_date,
            ]);

            return response()->json([
                "message" => "Book updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Books::where('id', $id)->exists()) {
            Books::destroy($id);

            return response()->json([
                "message" => "Records deleted successfully"
            ], 202);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }
}
