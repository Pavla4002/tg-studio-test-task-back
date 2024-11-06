<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::select('id', 'name')->get();
    }

    public function store(Request $request)
    {
        $author = new Author();
        $author->name = $request->name;
        $author->save();
        if ($author->save()) {
            return response()->json([
                'id' => $author->id,
                'name' => $author->name,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Ошибка во время создания новго автора',
            ], 422);
        }
    }
}
