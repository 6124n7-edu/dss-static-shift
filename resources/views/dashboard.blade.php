@extends('layouts.app')

@section('title', 'Dashboard Ringkasan')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Card 1 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-indigo-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-500">
                <i class="fa-solid fa-list text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Total Alternatif</p>
                <h3 class="text-2xl font-bold text-gray-700">{{ \App\Models\Alternative::count() }}</h3>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-500">
                <i class="fa-solid fa-layer-group text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Kriteria Penilaian</p>
                <h3 class="text-2xl font-bold text-gray-700">{{ \App\Models\Criteria::count() }}</h3>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                <i class="fa-solid fa-check-double text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Status Sistem</p>
                <h3 class="text-lg font-bold text-gray-700">Siap Hitung</h3>
            </div>
        </div>
    </div>
</div>

<div class="bg-white p-8 rounded-lg shadow-md text-center">
    <h3 class="text-xl font-bold text-gray-800 mb-2">Selamat Datang di SPK Static Shift Racing</h3>
    <p class="text-gray-600 mb-6">Sistem ini membantu menentukan prioritas pengembangan fitur game menggunakan metode ARAS.</p>
    <a href="{{ route('aras.result') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 font-bold transition">
        <i class="fa-solid fa-rocket mr-2"></i> Jalankan Perhitungan ARAS
    </a>
</div>
@endsection