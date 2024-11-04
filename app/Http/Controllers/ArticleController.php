<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
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

        $article = new Article();
        $article->title = $request->title;
        $article->text = $request->text;
        $article->author_id = $request->author_id;
        $article->save();
        if ($article->save()) {
            return response()->json([
                'data' => [
                    'message' => 'Статья успешно создана',
                    'article' => $article,
                ]
            ], 201);
        } else {
            return response()->json([
                'message' => 'Ошибка во время создания статьи',
            ], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->text = $request->text;
        $article->author_id = $request->author_id;
        $article->update();
        return response()->json($article, 200);
    }

    public function destroy($id)
    {
        Article::destroy($id);
        return response()->json($id, 200);
    }
}
