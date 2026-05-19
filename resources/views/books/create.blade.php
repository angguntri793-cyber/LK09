@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-5">
        Tambah Buku
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

    <form action="{{ route('books.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text"
                   name="title"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Penulis</label>
            <input type="text"
                   name="author"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Penerbit</label>
            <input type="text"
                   name="publisher"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="number"
                   name="year"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category"
        class="w-full border p-2 rounded">

    <option value="">-- Pilih Kategori --</option>

    <option value="Novel">Novel</option>
    <option value="Pendidikan">Pendidikan</option>
    <option value="Teknologi">Teknologi</option>
    <option value="Agama">Agama</option>
    <option value="Sejarah">Sejarah</option>
    <option value="Komik">Komik</option>
    <option value="Sains">Sains</option>
    <option value="Bahasa">Bahasa</option>
    <option value="Biografi">Biografi</option>
    <option value="Lainnya">Lainnya</option>

</select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description"
                      class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-3">
            <label>Cover Buku</label>
            <input type="file"
                   name="cover"
                   class="w-full border p-2 rounded">
        </div>

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>

    </form>

</div>

@endsection