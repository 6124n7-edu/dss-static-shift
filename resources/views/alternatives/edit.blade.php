@extends('layouts.app')

@section('title', 'Edit Alternatif')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('alternatives.update', $alternative->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Alternatif</label>
            <input type="text" name="name" value="{{ $alternative->name }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-indigo-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-indigo-500" rows="3">{{ $alternative->description }}</textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('alternatives.index') }}" class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-bold">Update</button>
        </div>
    </form>
</div>
@endsection