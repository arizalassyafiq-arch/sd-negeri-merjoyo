<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
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
            // Validasi file gambar (max 2MB)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke folder: storage/app/public/articles
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        // --- PERBAIKAN DI SINI ---
        // kalau dah buat login hapus ini
        // Cek apakah ada user login? Jika tidak, pakai ID 1 sebagai default (sementara)
        $authorId = Auth::id() ?? 1;

        // Pastikan tabel users minimal punya 1 data user ya!

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'content' => $request->content,
            'image_path' => $imagePath, // Simpan path-nya (misal: articles/namafile.jpg)
            'published_at' => $request->published_at,
            // 'author_id' => Auth::id(), nyalakan kalau dah ada login
            'author_id' => $authorId,
        ]);

        return redirect()->route('admin.artikel.index')->with('status', 'Artikel berhasil ditambahkan!');
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
            // Jika ingin slug berubah saat judul berubah, uncomment baris bawah:
            // 'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'content' => $request->content,
            'published_at' => $request->published_at,
        ];

        // Cek jika ada file baru diupload
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama jika ada
            if ($artikel->image_path && Storage::disk('public')->exists($artikel->image_path)) {
                Storage::disk('public')->delete($artikel->image_path);
            }

            // 2. Upload gambar baru
            $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path;
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('status', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $artikel)
    {
        // Hapus fisik gambar saat artikel dihapus
        if ($artikel->image_path && Storage::disk('public')->exists($artikel->image_path)) {
            Storage::disk('public')->delete($artikel->image_path);
        }

        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('status', 'Artikel berhasil dihapus.');
    }
}
