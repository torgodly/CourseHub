<form method="POST" action="">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="current_password" class="block text-sm font-medium text-gray-700">{{ __('Current Password') }}</label>
        <input type="password" name="current_password" id="current_password"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('New Password') }}</label>
        <input type="password" name="password" id="password"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
        <label for="password_confirmation"
            class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <button type="submit"
        class="bg-color-primary-orange text-white px-4 py-2 rounded-md">{{ __('Update Password') }}</button>
</form>
