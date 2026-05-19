<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'category' => $request->category,
            'description' => $request->description,
            'cover' => $coverPath
        ]);

        return redirect()->route('books.index')
                         ->with('success', 'Data buku berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $coverPath = $book->cover;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'category' => $request->category,
            'description' => $request->description,
            'cover' => $coverPath
        ]);

        return redirect()->route('books.index')
                         ->with('success', 'Data buku berhasil diubah');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Data buku berhasil dihapus');
    }
}