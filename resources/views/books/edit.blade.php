@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-5">
        Edit Buku
    </h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text"
                   name="title"
                   value="{{ $book->title }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Penulis</label>
            <input type="text"
                   name="author"
                   value="{{ $book->author }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Penerbit</label>
            <input type="text"
                   name="publisher"
                   value="{{ $book->publisher }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="number"
                   name="year"
                   value="{{ $book->year }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <<select name="category"
        class="w-full border p-2 rounded">

    <option value="Novel"
        {{ $book->category == 'Novel' ? 'selected' : '' }}>
        Novel
    </option>

    <option value="Pendidikan"
        {{ $book->category == 'Pendidikan' ? 'selected' : '' }}>
        Pendidikan
    </option>

    <option value="Teknologi"
        {{ $book->category == 'Teknologi' ? 'selected' : '' }}>
        Teknologi
    </option>

    <option value="Agama"
        {{ $book->category == 'Agama' ? 'selected' : '' }}>
        Agama
    </option>

    <option value="Sejarah"
        {{ $book->category == 'Sejarah' ? 'selected' : '' }}>
        Sejarah
    </option>

    <option value="Komik"
        {{ $book->category == 'Komik' ? 'selected' : '' }}>
        Komik
    </option>

    <option value="Sains"
        {{ $book->category == 'Sains' ? 'selected' : '' }}>
        Sains
    </option>

    <option value="Bahasa"
        {{ $book->category == 'Bahasa' ? 'selected' : '' }}>
        Bahasa
    </option>

    <option value="Biografi"
        {{ $book->category == 'Biografi' ? 'selected' : '' }}>
        Biografi
    </option>

    <option value="Lainnya"
        {{ $book->category == 'Lainnya' ? 'selected' : '' }}>
        Lainnya
    </option>

</select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description"
                      class="w-full border p-2 rounded">{{ $book->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Cover Lama</label><br>

            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}"
                     width="100"
                     class="mb-2">
            @endif

            <input type="file"
                   name="cover"
                   class="w-full border p-2 rounded">
        </div>

        <button type="submit"
                class="bg-yellow-500 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>

@endsection