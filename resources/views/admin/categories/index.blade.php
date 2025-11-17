@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold  text-gray-800">Kelola Kategori</h1>
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Slug</th>
                    <th class="px-4 py-2 text-left">Jumlah Produk</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2">{{ $category->slug }}</td>
                    <td class="px-4 py-2">{{ $category->products_count }}</td>
                    <td class="px-4 py-2">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-2 py-1 rounded text-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection