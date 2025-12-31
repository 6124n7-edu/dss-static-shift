<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSS Static Shift Racing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:block">
            <div class="h-16 flex items-center justify-center border-b border-gray-800 font-bold text-xl tracking-wider">
                <i class="fa-solid fa-flag-checkered mr-2 text-indigo-500"></i> SSR DSS
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center px-4 py-3 text-sm font-medium rounded-md hover:bg-gray-800 transition {{ request()->routeIs('dashboard') ? 'bg-indigo-600' : '' }}">
                    <i class="fa-solid fa-gauge w-6 text-center mr-2"></i> Dashboard
                </a>

                <p class="px-4 mt-6 mb-2 text-xs font-semibold text-gray-500 uppercase">Master Data</p>

                <!-- Criteria -->
                <a href="{{ route('criteria.index') }}"
                    class="group flex items-center px-4 py-3 text-sm font-medium rounded-md hover:bg-gray-800 transition {{ request()->routeIs('criteria.*') ? 'bg-indigo-600' : '' }}">
                    <i class="fa-solid fa-layer-group w-6 text-center mr-2"></i> Data Kriteria
                </a>

                <!-- Alternatives -->
                <a href="{{ route('alternatives.index') }}"
                    class="group flex items-center px-4 py-3 text-sm font-medium rounded-md hover:bg-gray-800 transition {{ request()->routeIs('alternatives.*') ? 'bg-indigo-600' : '' }}">
                    <i class="fa-solid fa-list w-6 text-center mr-2"></i> Data Alternatif
                </a>

                <p class="px-4 mt-6 mb-2 text-xs font-semibold text-gray-500 uppercase">Proses SPK</p>

                <!-- Evaluation -->
                <a href="{{ route('evaluations.index') }}"
                    class="group flex items-center px-4 py-3 text-sm font-medium rounded-md hover:bg-gray-800 transition {{ request()->routeIs('evaluations.*') ? 'bg-indigo-600' : '' }}">
                    <i class="fa-solid fa-pen-to-square w-6 text-center mr-2"></i> Penilaian
                </a>

                <!-- Calculation -->
                <a href="{{ route('aras.result') }}"
                    class="group flex items-center px-4 py-3 text-sm font-medium rounded-md hover:bg-gray-800 transition {{ request()->routeIs('aras.*') ? 'bg-indigo-600' : '' }}">
                    <i class="fa-solid fa-calculator w-6 text-center mr-2"></i> Hasil ARAS
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header Section -->
            <header class="h-16 bg-white border-b flex items-center justify-between px-6 shadow-sm">
                <!-- Page Title -->
                <h2 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>

                <div class="flex items-center gap-4">
                    <!-- User Info (Dynamic) -->
                    <div class="flex items-center text-right">
                        <div class="mr-3 hidden md:block">
                            <!-- Display Real User Name -->
                            <p class="text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Guest' }}</p>
                            <p class="text-xs text-gray-500 uppercase">{{ Auth::user()->role ?? 'User' }}</p>
                        </div>
                        <!-- Initials Avatar -->
                        <div
                            class="h-9 w-9 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold shadow-md uppercase">
                            {{ substr(Auth::user()->name ?? 'G', 0, 1) }}
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-gray-400 hover:text-red-500 transition p-2 rounded-full hover:bg-gray-100"
                            title="Logout" onclick="return confirm('Keluar dari sistem?');">
                            <i class="fa-solid fa-right-from-bracket text-xl"></i>
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>
