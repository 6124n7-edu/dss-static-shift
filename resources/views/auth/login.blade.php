<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SSR Analytics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-2xl w-96">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-600 mb-4">
                <i class="fa-solid fa-flag-checkered text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">SSR Analytics</h2>
            <p class="text-gray-500 text-sm">Masuk Sistem SPK</p>
        </div>

        <!-- Error Message Display -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" name="email" class="w-full pl-10 pr-3 py-2 border rounded-lg focus:outline-none focus:border-indigo-500" placeholder="admin@ssr.com" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="w-full pl-10 pr-3 py-2 border rounded-lg focus:outline-none focus:border-indigo-500" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                Sign In
            </button>
        </form>
        
        <p class="text-center text-gray-400 text-xs mt-6">&copy; 2025 Static Shift Racing DSS</p>
    </div>

</body>
</html>