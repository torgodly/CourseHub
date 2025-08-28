@extends('layouts.app')

@section('content')
    <div class="container min-h-[60vh] mx-auto px-4 py-10 mt-20 max-w-3xl">

        {{-- User Avatar + Name --}}
        <div class="flex flex-col items-center mb-10">
            <div class="relative">
                <img src="{{auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                     alt="Avatar"
                     class="w-28 h-28 rounded-full object-cover border-4 border-primary-color shadow">
                <label for="avatar-upload"
                       class="absolute bottom-0 right-0 bg-primary-color text-white p-2 rounded-full cursor-pointer hover:opacity-90">
                    <x-tabler-camera-filled class="w-5 h-5 fill-primary-orange"/>
                </label>
            </div>
            <h1 class="mt-4 text-2xl font-bold">{{ auth()->user()->name }}</h1>
            <p class="text-gray-500">{{ auth()->user()->email }}</p>
        </div>

        {{-- Update Profile --}}
        <div class="bg-gray-50 p-6 rounded-2xl shadow-sm mb-8">
            <h2 class="text-lg font-semibold mb-5">{{ __('Update Profile') }}</h2>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Avatar Upload --}}
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                             alt="Avatar"
                             class="w-20 h-20 rounded-full object-cover border border-gray-300 shadow">
                    </div>
                    <div>
                        <label for="avatar-upload"
                               class="cursor-pointer px-3 py-2 bg-primary-orange text-white text-sm rounded-lg hover:opacity-90">
                            {{ __('Change Avatar') }}
                        </label>
                        <input id="avatar-upload" type="file" name="avatar" class="hidden" />
                        <p class="text-xs text-gray-500 mt-1">{{ __('JPG, PNG up to 2MB') }}</p>
                    </div>
                </div>

                {{-- Name --}}
                <div>
                    <label class="block text-sm text-gray-600 mb-1">{{ __('Name') }}</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-primary-color focus:border-primary-color">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm text-gray-600 mb-1">{{ __('Email') }}</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-primary-color focus:border-primary-color">
                </div>

                {{-- Save Button --}}
                <button type="submit"
                        class="w-full py-2 bg-primary-orange text-white rounded-xl font-medium hover:opacity-90">
                    {{ __('Save Changes') }}
                </button>
            </form>
        </div>


        {{-- Update Password --}}
        <div class="bg-gray-50 p-6 rounded-2xl shadow-sm">
            <h2 class="text-lg font-semibold mb-5">{{ __('Change Password') }}</h2>
            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm text-gray-600 mb-1">{{ __('Current Password') }}</label>
                    <input type="password" name="current_password"
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-primary-color focus:border-primary-color">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">{{ __('New Password') }}</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-primary-color focus:border-primary-color">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-primary-color focus:border-primary-color">
                </div>

                <button type="submit"
                        class="w-full py-2 bg-primary-orange text-white rounded-xl font-medium hover:opacity-90">
                    {{ __('Update Password') }}
                </button>
            </form>
        </div>
    </div>
@endsection
