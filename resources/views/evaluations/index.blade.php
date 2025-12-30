@extends('layouts.app')
@section('title', 'Penilaian Alternatif')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-4 border-b">Nama Alternatif</th>
                <th class="p-4 border-b text-center">Status</th>
                <th class="p-4 border-b text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alternatives as $alt)
            <tr class="hover:bg-gray-50 border-b">
                <td class="p-4 font-semibold">{{ $alt->name }}</td>
                <td class="p-4 text-center">
                    <!-- Check if scores exist (Simplified check) -->
                    @if(\App\Models\Evaluation::where('alternative_id', $alt->id)->exists())
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Dinilai</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Belum</span>
                    @endif
                </td>
                <td class="p-4 text-center">
                    <a href="{{ route('evaluations.edit', $alt->id) }}" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-sm">
                        <i class="fa-solid fa-pen mr-1"></i> Input Nilai
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection