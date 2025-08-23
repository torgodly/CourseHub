<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <button type="submit"
        class="bg-color-primary-orange text-white px-4 py-2 rounded-md">{{ __('Update Profile') }}</button>
</form>
