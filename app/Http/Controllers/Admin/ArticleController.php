<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.artikel.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'excerpt' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $slug = $this->makeSlug($validated['title']);

        $excerpt = $validated['excerpt'];
        if (!$excerpt) {
            $excerpt = Str::limit(trim(strip_tags($validated['content'])), 160);
        }

        Article::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $excerpt,
            'content' => $validated['content'],
            'image_url' => $validated['image_url'],
            'published_at' => $validated['published_at'] ?? now(),
        ]);

        return redirect()
            ->route('admin.artikel.index')
            ->with('status', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);

        return view('admin.artikel.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'excerpt' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $slug = $this->makeSlug($validated['title'], $article);

        $excerpt = $validated['excerpt'];
        if (!$excerpt) {
            $excerpt = Str::limit(trim(strip_tags($validated['content'])), 160);
        }

        $article->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $excerpt,
            'content' => $validated['content'],
            'image_url' => $validated['image_url'],
            'published_at' => $validated['published_at'] ?? $article->published_at ?? now(),
        ]);

        return redirect()
            ->route('admin.artikel.index')
            ->with('status', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()
            ->route('admin.artikel.index')
            ->with('status', 'Artikel berhasil dihapus.');
    }

    private function makeSlug(string $title, ?Article $article = null): string
    {
        $base = Str::slug($title);
        if ($base === '') {
            $base = Str::random(8);
        }

        $slug = $base;
        $counter = 1;

        $exists = Article::query()
            ->when($article, fn($query) => $query->where('id', '!=', $article->id))
            ->where('slug', $slug)
            ->exists();

        while ($exists) {
            $slug = $base . '-' . $counter;
            $counter++;
            $exists = Article::query()
                ->when($article, fn($query) => $query->where('id', '!=', $article->id))
                ->where('slug', $slug)
                ->exists();
        }

        return $slug;
    }
}
