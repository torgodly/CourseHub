@extends('layouts.app')

@section('content')
    <div class="container min-h-[60vh] mx-auto px-4 py-10 mt-20 max-w-3xl">

        {{-- User Avatar + Name --}}
        <div class="flex flex-col items-center mb-10">
            <div class="relative">
                <img
                    src="{{auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
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
                        <img
                            src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                            alt="Avatar"
                            class="w-20 h-20 rounded-full object-cover border border-gray-300 shadow">
                    </div>
                    <div>
                        <label for="avatar-upload"
                               class="cursor-pointer px-3 py-2 bg-primary-orange text-white text-sm rounded-lg hover:opacity-90">
                            {{ __('Change Avatar') }}
                        </label>
                        <input id="avatar-upload" type="file" name="avatar" class="hidden"/>
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

        @if(auth()->user()->type == 'user')
            {{-- Become a Trainer (Alpine.js Scope) --}}
            <div x-data="{ showTrainerModal: false }"> {{-- Alpine.js component scope --}}
                <div class="bg-gray-50 p-6 rounded-2xl shadow-sm mt-8">
                    <h2 class="text-lg font-semibold mb-5 text-start">{{ __('Become a Trainer') }}</h2> {{-- Added text-start for explicit logical alignment --}}
                    <p class="text-gray-600 mb-4 text-start">{{ __('Are you an expert in your field? Join our team of trainers and share your knowledge with the world.') }}</p> {{-- Added text-start --}}
                    <button @click="showTrainerModal = true" {{-- Open modal when clicked --}}
                    class="w-full py-2 bg-primary-orange text-white rounded-xl font-medium hover:opacity-90">
                        {{ __('Apply Now') }}
                    </button>
                </div>

                {{-- Trainer Application Modal (controlled by Alpine) --}}
                <div x-show="showTrainerModal" {{-- Show/hide based on showTrainerModal state --}}
                x-cloak {{-- Hide until Alpine is initialized --}}
                     @click.outside="showTrainerModal = false" {{-- Close when clicking outside --}}
                     @keydown.escape.window="showTrainerModal = false" {{-- Close when pressing Escape --}}
                     class="fixed inset-0 bg-opacity-50 backdrop-blur-sm transition-opacity flex items-center justify-center z-50">
                    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-lg w-full">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-start">{{ __('Trainer Application') }}</h2> {{-- Added text-start --}}
                            <button @click="showTrainerModal = false" {{-- Close modal --}}
                            class="text-gray-500 hover:text-gray-700">
                                <x-tabler-x class="w-6 h-6"/>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('trainer.submit') }}" enctype="multipart/form-data"
                              class="space-y-4">
                            @csrf

                            {{-- Qualification --}}
                            <div>
                                <label for="qualification"
                                       class="block text-sm font-medium text-gray-700 text-start">{{ __('Qualification') }}</label> {{-- Added text-start --}}
                                <input type="text" name="qualification" id="qualification" required
                                       class="mt-1 block w-full px-4 py-2 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-primary-color focus:border-primary-color">
                            </div>

                            {{-- Profession --}}
                            <div>
                                <label for="profession"
                                       class="block text-sm font-medium text-gray-700 text-start">{{ __('Profession') }}</label> {{-- Added text-start --}}
                                <input type="text" name="profession" id="profession" required
                                       class="mt-1 block w-full px-4 py-2 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-primary-color focus:border-primary-color">
                            </div>

                            {{-- Resume --}}
                            <div>
                                <label for="resume"
                                       class="block text-sm font-medium text-gray-700 text-start">{{ __('Resume (PDF)') }}</label> {{-- Added text-start --}}
                                <input type="file" name="resume" id="resume" required accept=".pdf"
                                       class="mt-1 block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-orange file:text-white hover:file:bg-opacity-90"> {{-- Changed file:mr-4 to file:me-4 --}}
                            </div>

                            {{-- Avatar --}}
                            <div>
                                <label for="modal-avatar"
                                       class="block text-sm font-medium text-gray-700 text-start">{{ __('Avatar (Image)') }}</label> {{-- Added text-start --}}
                                <input type="file" name="avatar" id="modal-avatar" required accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-orange file:text-white hover:file:bg-opacity-90"> {{-- Changed file:mr-4 to file:me-4 --}}
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="button" @click="showTrainerModal = false" {{-- Close modal --}}
                                class="me-4 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">{{ __('Cancel') }}</button> {{-- Changed mr-4 to me-4 --}}
                                <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-primary-orange rounded-lg hover:opacity-90 cursor-pointer">{{ __('Submit Application') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> {{-- End of Alpine.js component scope --}}
        @endif

    </div>

    {{-- The @push('scripts') block is completely removed --}}

@endsection
