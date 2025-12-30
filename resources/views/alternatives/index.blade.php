@extends('layouts.app')

@section('title', 'Data Alternatif')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-gray-700">Daftar Fitur / Bug</h3>
        <a href="{{ route('alternatives.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Alternatif
        </a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-4 border-b">ID</th>
                <th class="p-4 border-b">Nama Alternatif</th>
                <th class="p-4 border-b">Deskripsi</th>
                <th class="p-4 border-b text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alternatives as $alt)
            <tr class="hover:bg-gray-50 border-b">
                <td class="p-4">{{ $alt->id }}</td>
                <td class="p-4 font-semibold">{{ $alt->name }}</td>
                <td class="p-4 text-gray-500">{{ $alt->description ?? '-' }}</td>
                <td class="p-4 text-center">
                    <form action="{{ route('alternatives.destroy', $alt->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                        <a href="{{ route('alternatives.edit', $alt->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fa-solid fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection