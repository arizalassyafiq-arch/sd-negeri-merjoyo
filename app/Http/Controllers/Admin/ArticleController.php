<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    // Helper function untuk menentukan redirect ke mana
    private function getRedirectRoute()
    {
        return Auth::user()->role === 'guru' ? 'guru.artikel.index' : 'admin.artikel.index';
    }

    public function index()
    {
        // Pastikan view-nya bisa dipakai admin & guru
        $articles = Article::latest()->paginate(10);
        return view('admin.artikel.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $authorId = Auth::id() ?? 1;

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'content' => $request->content,
            'image_path' => $imagePath,
            'published_at' => $request->published_at,
            'author_id' => $authorId,
        ]);

        // GANTI REDIRECT DI SINI
        return redirect()->route($this->getRedirectRoute())
            ->with('status', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Article $artikel)
    {
        return view('admin.artikel.edit', ['article' => $artikel]);
    }

    public function update(Request $request, Article $artikel)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
        ];

        if ($request->hasFile('image')) {
            if ($artikel->image_path && Storage::disk('public')->exists($artikel->image_path)) {
                Storage::disk('public')->delete($artikel->image_path);
            }
            $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path;
        }

        $artikel->update($data);

        // GANTI REDIRECT DI SINI
        return redirect()->route($this->getRedirectRoute())
            ->with('status', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $artikel)
    {
        if ($artikel->image_path && Storage::disk('public')->exists($artikel->image_path)) {
            Storage::disk('public')->delete($artikel->image_path);
        }

        $artikel->delete();

        // GANTI REDIRECT DI SINI
        return redirect()->route($this->getRedirectRoute())
            ->with('status', 'Artikel berhasil dihapus.');
    }
}
