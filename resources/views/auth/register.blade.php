<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Register') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center p-4 relative overflow-hidden">
<div class="w-full max-w-md mx-auto relative z-10">
    <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-gray-100">
        <div class="text-center mb-8 flex flex-col items-center">
            <a href="/" class="relative -top-2">
                <img src="{{ asset('images/Red AFAQ Logo Ver.png') }}" alt="AFAQ logo" class="w-28 h-auto md:w-36">
            </a>
            <p class="text-lg text-gray-600 font-medium">{{__('Join our community of learners')}}</p>
        </div>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">{{ __('Name') }}</label>
                <input type="text" name="name" id="name"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all @error('name') border-red-500 @enderror"
                       required autofocus value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">{{ __('Email Address') }}</label>
                <input type="email" name="email" id="email"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all @error('email') border-red-500 @enderror"
                       required value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">{{ __('Password') }}</label>
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all @error('password') border-red-500 @enderror"
                       required>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">{{ __('Confirm Password') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all @error('password_confirmation') border-red-500 @enderror"
                       required>
                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit"
                        class="w-full bg-primary-orange text-white rounded-xl font-bold py-3 px-4 hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-blue-500/40">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <p class="text-gray-600">{{ __('Already have an account?') }} <a href="{{ route('login') }}"
                                                                             class="text-blue-600 hover:text-blue-700 font-bold transition-colors duration-300">{{ __('Login') }}</a>
            </p>
        </div>
    </div>
</div>
</body>

</html>
