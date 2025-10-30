<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ asset('image/ajii.jpg') }}" alt="Your Company"
                class="mx-auto h-16 w-auto rounded-full shadow-md" />
            <h2 class="mt-2 text-center text-2xl font-bold tracking-tight text-gray-900">
                Create your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

            {{-- ✅ Alert Sukses --}}
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 p-3 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ❌ Error Validasi --}}
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-100 p-3 text-red-700 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register.process') }}" class="space-y-6">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900">Full Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            placeholder="Your name" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 
                     outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 
                     focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            placeholder="you@example.com" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 
                     outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 
                     focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" placeholder="********" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 
                     outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 
                     focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm
                        Password</label>
                    <div class="mt-2">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="********" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 
                     outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 
                     focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <!-- Button -->
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white 
                   shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 
                   focus-visible:outline-indigo-600">
                        Register
                    </button>
                </div>
            </form>
            @if (session('success'))
                <div class="mt-4 text-green-600">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="mt-4 text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Link ke login -->
            <p class="mt-10 text-center text-sm text-gray-500">
                Already have an account?
                <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>
    </div>
</body>

</html>
