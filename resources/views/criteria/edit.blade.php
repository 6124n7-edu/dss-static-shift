@extends('layouts.app')

@section('title', 'Edit Kriteria: ' . $criterion->code)

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('criteria.update', $criterion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Kriteria</label>
            <input type="text" name="name" value="{{ $criterion->name }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-indigo-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Jenis (Type)</label>
            <select name="type" class="w-full border rounded px-3 py-2 bg-white">
                <option value="Benefit" {{ $criterion->type == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                <option value="Cost" {{ $criterion->type == 'Cost' ? 'selected' : '' }}>Cost</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Bobot (Weight)</label>
            <input type="number" step="0.01" name="weight" value="{{ $criterion->weight }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-indigo-500">
            <p class="text-xs text-gray-500 mt-1">Gunakan desimal (Contoh: 0.40)</p>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('criteria.index') }}" class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-bold">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection