<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    /**
     * Menampilkan daftar artikel (Halaman Depan)
     */
    public function index(Request $request)
    {

        // 1. Mulai query artikel
        // Hanya tampilkan artikel yang sudah ada tanggal publikasinya (bukan draft)
        $query = Article::query()
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        // 2. Fitur Pencarian (Search)
        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // 3. Fitur Filter Kategori (Opsional - Jika kolom category sudah ada di DB)
        // Jika kolom 'category' belum ada di tabel articles, hapus bagian ini agar tidak error.
        if ($request->has('category') && $request->category != '') {
            // $query->where('category', $request->category); 
        }

        // 4. Urutkan dari yang terbaru & Pagination
        $articles = $query->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(9) // Tampilkan 9 artikel per halaman
            ->withQueryString(); // Agar parameter search tidak hilang saat ganti halaman

        // Return ke view public (pastikan nama folder/file view sesuai)
        return view('pages.artikel.index', compact('articles'));
    }

    /**
     * Menampilkan detail satu artikel
     */
    public function show($slug)
    {
        // 1. Cari artikel berdasarkan Slug
        $article = Article::with('author')
            ->where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail(); // 404 jika tidak ketemu

        // 2. Ambil artikel terbaru lainnya untuk Sidebar (Recent Posts)
        $recent = Article::where('id', '!=', $article->id) // Jangan tampilkan artikel yang sedang dibuka
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        return view('pages.artikel.detail', compact('article', 'recent'));
    }
}
