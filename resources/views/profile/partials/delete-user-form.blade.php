<form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')

    <p class="text-sm text-gray-600 mb-4">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data or information you wish to retain before deleting your account.') }}</p>

    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">{{ __('Delete Account') }}</button>
</form>
