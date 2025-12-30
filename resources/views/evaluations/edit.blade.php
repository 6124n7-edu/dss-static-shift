@extends('layouts.app')
@section('title', 'Input Nilai: ' . $alternative->name)
@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('evaluations.update', $alternative->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-700 mb-2">{{ $alternative->name }}</h3>
            <p class="text-sm text-gray-500">Masukkan nilai 1-5 untuk setiap kriteria.</p>
        </div>

        @foreach($criterias as $criteria)
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                {{ $criteria->code }} - {{ $criteria->name }} 
                <span class="text-xs text-gray-400">({{ $criteria->type }})</span>
            </label>
            <select name="scores[{{ $criteria->id }}]" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-indigo-500" required>
                <option value="">-- Pilih Nilai --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ ($existingEvaluations[$criteria->id] ?? '') == $i ? 'selected' : '' }}>
                        {{ $i }} 
                        @if($i==1) (Sangat Rendah/Buruk) @elseif($i==5) (Sangat Tinggi/Baik) @endif
                    </option>
                @endfor
            </select>
        </div>
        @endforeach

        <div class="flex justify-end mt-6">
            <a href="{{ route('evaluations.index') }}" class="text-gray-600 mr-4 py-2">Batal</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 font-bold">
                Simpan Penilaian
            </button>
        </div>
    </form>
</div>
@endsection