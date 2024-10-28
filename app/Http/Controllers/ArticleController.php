<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

//    Получение списка articles
    public function index()
    {
        return Article::with('author:id,name')->get(['id', 'author_id', 'title']);
    }

    public function show($id)
    {
        return Article::with('author')->findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            $article = Article::create($request->all());
            return response()->json($article, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create resource'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return response()->json($article, 200);
    }

    public function destroy($id)
    {
        Article::destroy($id);
        return response()->json(null, 204);
    }
}
