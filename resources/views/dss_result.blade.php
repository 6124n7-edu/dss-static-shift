@extends('layouts.app')

@section('title', 'Hasil Perhitungan ARAS')

@section('content')
<div class="max-w-7xl mx-auto">
    
    <!-- HEADER SECTION -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Laporan Keputusan</h3>
            <p class="text-gray-500 text-sm">Metode Additive Ratio Assessment (ARAS)</p>
        </div>
        <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 text-sm">
            <i class="fa-solid fa-print mr-2"></i> Cetak Laporan
        </button>
    </div>

    <!-- 1. FINAL RANKING TABLE (The Main Result) -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8 border-t-4 border-indigo-600">
        <div class="p-6 border-b border-gray-100 bg-indigo-50">
            <h4 class="font-bold text-indigo-900 flex items-center">
                <i class="fa-solid fa-trophy mr-2 text-yellow-600"></i> Peringkat Prioritas Pengembangan
            </h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="p-4 border-b text-center w-24">Rank</th>
                        <th class="p-4 border-b">Nama Alternatif</th>
                        <th class="p-4 border-b text-center">Nilai Si (Optimalitas)</th>
                        <th class="p-4 border-b text-center">Nilai Ki (Utilitas)</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php $rank = 1; @endphp
                    @foreach($Ki as $id => $score)
                        @php 
                            $name = $alternatives->find($id)->name ?? 'Unknown';
                            $isWinner = $rank == 1;
                            $rowClass = $isWinner ? 'bg-green-50' : 'hover:bg-gray-50';
                        @endphp
                        <tr class="{{ $rowClass }} border-b last:border-b-0">
                            <td class="p-4 text-center font-bold text-lg">
                                @if($isWinner) <i class="fa-solid fa-crown text-yellow-500 mr-1"></i> @endif
                                {{ $rank++ }}
                            </td>
                            <td class="p-4 font-medium {{ $isWinner ? 'text-green-700 font-bold' : '' }}">
                                {{ $name }}
                            </td>
                            <td class="p-4 text-center text-gray-500 font-mono">
                                {{ number_format($Si[$id] ?? 0, 4) }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-full font-bold {{ $isWinner ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                                    {{ number_format($score, 4) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. CALCULATION DETAILS (Accordion Style) -->
    <div class="space-y-4">
        
        <!-- Matriks X -->
        <details class="bg-white rounded-lg shadow-sm group">
            <summary class="list-none flex flex-wrap items-center cursor-pointer focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-500 rounded group-open:rounded-b-none group-open:z-[1] relative p-4 bg-gray-50 hover:bg-gray-100">
                <h3 class="flex flex-1 group-open:text-indigo-700 font-semibold">
                    1. Matriks Keputusan Awal (X) & Nilai Optimal (A0)
                </h3>
                <div class="flex w-10 items-center justify-center">
                    <div class="border-8 border-transparent border-l-gray-600 ml-2 group-open:rotate-90 transition-transform origin-left"></div>
                </div>
            </summary>
            <div class="p-4 overflow-x-auto">
                <table class="w-full text-sm border text-left">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Alternatif</th>
                            @foreach($criterias as $c) 
                                <th class="p-2 border text-center">
                                    {{ $c->code }} <br> 
                                    <span class="text-[10px] text-gray-500">{{ $c->type }}</span>
                                </th> 
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-yellow-100 font-bold text-yellow-900">
                            <td class="p-2 border">A0 (Optimal)</td>
                            @foreach($criterias as $c) 
                                <td class="p-2 border text-center">{{ $A0[$c->id] }}</td> 
                            @endforeach
                        </tr>
                        @foreach($alternatives as $a)
                        <tr>
                            <td class="p-2 border font-medium">{{ $a->name }}</td>
                            @foreach($criterias as $c) 
                                <td class="p-2 border text-center">{{ $matrix[$a->id][$c->id] ?? 0 }}</td> 
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </details>

        <!-- Matriks R -->
        <details class="bg-white rounded-lg shadow-sm group">
            <summary class="list-none flex flex-wrap items-center cursor-pointer focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-500 rounded group-open:rounded-b-none group-open:z-[1] relative p-4 bg-gray-50 hover:bg-gray-100">
                <h3 class="flex flex-1 group-open:text-indigo-700 font-semibold">
                    2. Matriks Normalisasi (R)
                </h3>
                <div class="flex w-10 items-center justify-center">
                    <div class="border-8 border-transparent border-l-gray-600 ml-2 group-open:rotate-90 transition-transform origin-left"></div>
                </div>
            </summary>
            <div class="p-4 overflow-x-auto">
                <table class="w-full text-sm border text-left">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Alternatif</th>
                            @foreach($criterias as $c) <th class="p-2 border text-center">{{ $c->code }}</th> @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-yellow-100 font-bold text-yellow-900">
                            <td class="p-2 border">A0 (Norm)</td>
                            @foreach($criterias as $c) 
                                <td class="p-2 border text-center">{{ number_format($R[0][$c->id] ?? 0, 4) }}</td> 
                            @endforeach
                        </tr>
                        @foreach($alternatives as $a)
                        <tr>
                            <td class="p-2 border font-medium">{{ $a->name }}</td>
                            @foreach($criterias as $c) 
                                <td class="p-2 border text-center">{{ number_format($R[$a->id][$c->id] ?? 0, 4) }}</td> 
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </details>

        <!-- Matriks D -->
        <details class="bg-white rounded-lg shadow-sm group">
            <summary class="list-none flex flex-wrap items-center cursor-pointer focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-500 rounded group-open:rounded-b-none group-open:z-[1] relative p-4 bg-gray-50 hover:bg-gray-100">
                <h3 class="flex flex-1 group-open:text-indigo-700 font-semibold">
                    3. Matriks Terbobot (D)
                </h3>
                <div class="flex w-10 items-center justify-center">
                    <div class="border-8 border-transparent border-l-gray-600 ml-2 group-open:rotate-90 transition-transform origin-left"></div>
                </div>
            </summary>
            <div class="p-4 overflow-x-auto">
                <table class="w-full text-sm border text-left">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Alternatif</th>
                            @foreach($criterias as $c) <th class="p-2 border text-center">{{ $c->code }}</th> @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alternatives as $a)
                        <tr>
                            <td class="p-2 border font-medium">{{ $a->name }}</td>
                            @foreach($criterias as $c) 
                                <td class="p-2 border text-center">{{ number_format($D[$a->id][$c->id] ?? 0, 4) }}</td> 
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </details>

    </div>
</div>
@endsection