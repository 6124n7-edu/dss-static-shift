@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="p-4 border-b">Kode</th>
                <th class="p-4 border-b">Nama Kriteria</th>
                <th class="p-4 border-b text-center">Jenis</th>
                <th class="p-4 border-b text-center">Bobot</th>
                <th class="p-4 border-b text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($criterias as $c)
            <tr class="hover:bg-gray-50 border-b">
                <td class="p-4 font-bold">{{ $c->code }}</td>
                <td class="p-4">{{ $c->name }}</td>
                <td class="p-4 text-center">
                    <span class="px-2 py-1 rounded text-xs font-semibold {{ $c->type == 'Benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $c->type }}
                    </span>
                </td>
                <td class="p-4 text-center font-mono">{{ $c->weight }}</td>
                <td class="p-4 text-center">
                    <a href="{{ route('criteria.edit', $c->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection