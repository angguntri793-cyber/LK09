@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-5">
        <div>
            <h1 class="text-3xl font-bold">
                Sistem Perpustakaan Digital
            </h1>

            @auth
                <p class="text-gray-600 mt-1">
                    Selamat datang, {{ Auth::user()->name }}
                </p>
            @endauth
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('books.create') }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Tambah Buku
    </a>

    <table class="w-full mt-5 border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Cover</th>
                <th class="border p-2">Judul</th>
                <th class="border p-2">Penulis</th>
                <th class="border p-2">Penerbit</th>
                <th class="border p-2">Tahun</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Deskripsi</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($books as $book)
            <tr>

                <td class="border p-2">
                    {{ $loop->iteration }}
                </td>

                <td class="border p-2">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}"
                             width="80">
                    @else
                        Tidak ada cover
                    @endif
                </td>

                <td class="border p-2">{{ $book->title }}</td>
                <td class="border p-2">{{ $book->author }}</td>
                <td class="border p-2">{{ $book->publisher }}</td>
                <td class="border p-2">{{ $book->year }}</td>
                <td class="border p-2">{{ $book->category }}</td>
                <td class="border p-2">{{ $book->description }}</td>

                <td class="border p-2">

                    <a href="{{ route('books.edit', $book->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Edit
                    </a>

                    <form action="{{ route('books.destroy', $book->id) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded"
                                onclick="return confirm('Hapus data?')">
                            Hapus
                        </button>
                    </form>

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="9" class="border p-3 text-center">
                    Data buku masih kosong
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection