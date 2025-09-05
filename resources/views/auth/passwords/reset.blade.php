<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Reset Your Password') }}</title>
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
            <p class="text-lg text-gray-600 font-medium">{{__('Reset Your Password')}}</p>
        </div>
        @if (session('status'))
            <div class="mb-4 text-green-600 font-medium text-center">
                {{ __(session('status')) }}
            </div>
        @endif


        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" value="{{old('email', $request->email)}}"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all @error('email') border-red-500 @enderror"
                       required>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">{{ __('New Password') }}</label>
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all @error('password') border-red-500 @enderror"
                       required>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">{{ __('Confirm New Password') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all"
                       required>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="w-full bg-primary-orange text-white rounded-xl font-bold py-3 px-4 hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-blue-500/40">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>

    </div>
</div>
</body>

</html>
