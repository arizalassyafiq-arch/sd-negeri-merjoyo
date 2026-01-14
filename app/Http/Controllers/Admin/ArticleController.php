<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// 1. IMPORT BARU UNTUK VERSI 3
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ArticleController extends Controller
{
    private function getRedirectRoute()
    {
        return Auth::user()->role === 'guru' ? 'guru.artikel.index' : 'admin.artikel.index';
    }

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
        // 1. Validasi
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;

        // 2. Logika Draft vs Publish (Dari diskusi sebelumnya)
        // Jika user klik tombol 'draft', kita set published_at jadi null
        $publishedAt = $request->input('status') === 'draft' ? null : ($request->published_at ?? now());

        // 3. Proses Upload & Convert WebP (VERSI 3)
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $filename = time() . '-' . Str::random(10) . '.webp';

            // Init Image Manager (V3)
            $manager = new ImageManager(new Driver());

            // Baca gambar
            $image = $manager->read($imageFile);

            // Convert ke WebP (quality 90)
            $encoded = $image->toWebp(90);

            // Simpan ke storage
            Storage::disk('public')->put('articles/' . $filename, (string) $encoded);

            $imagePath = 'articles/' . $filename;
        }

        $authorId = Auth::id() ?? 1;

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'content' => $request->content,
            'image_path' => $imagePath,
            'published_at' => $publishedAt, // Menggunakan logika draft
            'author_id' => $authorId,
        ]);

        return redirect()->route($this->getRedirectRoute())
            ->with('status', 'Artikel berhasil disimpan!');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Logika Draft vs Publish saat Update
        $publishedAt = $request->input('status') === 'draft' ? null : ($request->published_at ?? $artikel->published_at);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $publishedAt,
        ];

        // Logika Update Gambar + Convert WebP (VERSI 3)
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($artikel->image_path && Storage::disk('public')->exists($artikel->image_path)) {
                Storage::disk('public')->delete($artikel->image_path);
            }

            $imageFile = $request->file('image');
            $filename = time() . '-' . Str::random(10) . '.webp';

            // Init Image Manager (V3)
            $manager = new ImageManager(new Driver());

            // Baca & Convert
            $image = $manager->read($imageFile);
            $encoded = $image->toWebp(90);

            Storage::disk('public')->put('articles/' . $filename, (string) $encoded);

            $data['image_path'] = 'articles/' . $filename;
        }

        $artikel->update($data);

        return redirect()->route($this->getRedirectRoute())
            ->with('status', 'Artikel berhasil diperbarui!');
    }

    public function show(Article $artikel)
    {
        return view('admin.artikel.show', [
            'article' => $artikel
        ]);
    }

    public function destroy(Article $artikel)
    {
        if ($artikel->image_path && Storage::disk('public')->exists($artikel->image_path)) {
            Storage::disk('public')->delete($artikel->image_path);
        }

        $artikel->delete();

        return redirect()->route($this->getRedirectRoute())
            ->with('status', 'Artikel berhasil dihapus.');
    }
}
