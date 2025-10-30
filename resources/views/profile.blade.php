<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}</h1>
        <p>Email: {{ Auth::user()->email }}</p>
        <img src="{{ Auth::user()->avatar ?? asset('image/default-avatar.png') }}"
             alt="Avatar" class="w-24 h-24 rounded-full mt-4 border">
    </div>
</body>
</html>
