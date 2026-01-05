<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    //Menampilkan dashboard artikel
    public function index() {
        $articles_count = Article::count();
        return view('dashboard', compact('articles_count'));
    }

    public function create() {
        return view('articles.create');
    }

    public function list() {
        $articles = Article::with(['likes', 'comments'])->latest()->get();
        return view('articles.list', compact('articles'));
    }

    //Menyimpan artikel baru
     
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required', 
            'file' => 'required|max:2048',
            'category' => 'required'
        ]);

        $path = $request->file('file')->store('articles', 'public');

    Article::create([
    'title'     => $request->title,
    'category' => $request->category,
    'content'   => $request->input('content'),
    'file_path' => $path,
    'user_id'   => auth()->id(), 
    ]);

        return back()->with('success', 'Berhasil upload!');
    }

    public function download($id)
    {
        $article = Article::findOrFail($id);
        
        
        $path = storage_path('app/public/' . $article->file_path);
        return response()->download($path);
    }
    // Hapus Artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        if (Storage::disk('public')->exists($article->file_path)) {
            Storage::disk('public')->delete($article->file_path);
        }
        
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }

    public function edit($id) {
        $article = Article::findOrFail($id); 
        return view('articles.edit', compact('article'));
    }

   public function update(Request $request, $id) {
    // Validasi data yang masuk
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'category' => 'required' 
    ]);

    $article = Article::findOrFail($id);

    // Proses simpan ke database
    $article->update([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'category' => $request->input('category'),
    ]);

    return redirect()->route('articles.list')->with('success', 'Artikel berhasil diperbarui!');
    }
}