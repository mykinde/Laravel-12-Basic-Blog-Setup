<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to My Laravel App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') {{-- Ensure Vite is set up --}}
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center p-6 bg-white rounded-xl shadow-lg max-w-md">
            <h1 class="text-3xl font-bold mb-4">👋 Welcome to Laravel 12!</h1>
            <p class="mb-6 text-gray-600">You're running a fresh installation of Laravel.</p>
            <a href="{{ url('/dashboard') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Go to Dashboard
            </a>
        </div>
    </div>
</body>
</html>
