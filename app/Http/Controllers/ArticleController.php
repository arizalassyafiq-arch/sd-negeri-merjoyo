<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(6);

        $recommended = Article::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        

        return view('pages.artikel-page', compact('articles', 'recommended'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $recent = Article::query()
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('pages.artikel-detail', compact('article', 'recent'));
    }
}
