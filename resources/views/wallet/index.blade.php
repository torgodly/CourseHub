@extends('layouts.app')

@section('content')
    <div class="container min-h-[52vh] mx-auto px-4 py-8 mt-20">

        {{-- Title & Description --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">{{ __('Wallet') }}</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ __('Wallet Transactions and Management') }}
            </p>
        </div>
        @if ($wallet->transactions->count() > 0)
            <button type="button" x-data="{}" x-on:click="$dispatch('open-redeem-voucher-modal')"
                    class="mb-3 inline-flex items-center rounded-md bg-primary-orange px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-orange">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path
                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>
                </svg>
                {{ __('Redeem Voucher') }}
            </button>
        @endif

        <div>
            <div class="grid gap-4">
                @if ($wallet->transactions->count() > 0)
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-700 uppercase tracking-wider">
                                                {{ __('Transaction Type') }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-700 uppercase tracking-wider">
                                                {{ __('Amount') }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-700 uppercase tracking-wider">
                                                {{ __('Description') }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-700 uppercase tracking-wider">
                                                {{ __('Date') }}</th>
                                        </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200">
                                        @foreach ($wallet->transactions as $transaction)
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                    {{ __($transaction->type) }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                        <span
                                                            class="{{ $transaction->type === 'deposit' ? 'text-green-600' : 'text-red-600' }}">
                                                            {{ $transaction->type === 'deposit' ? '+' : '' }}{{ $transaction->amount }} د.ل
                                                        </span>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $transaction->meta[0] }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $transaction->created_at->format('M d, Y H:i') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center text-gray-500 py-10 border border-dashed border-gray-300 rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">{{ __('No transactions found.') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('Start by redeeming a voucher or purchasing courses to see transactions here.') }}</p>
                        <div class="mt-6">
                            {{-- This button now opens the modal for voucher redemption --}}
                            <button type="button" x-data="{}" x-on:click="$dispatch('open-redeem-voucher-modal')"
                                    class="inline-flex items-center rounded-md bg-primary-orange px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-orange">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                     aria-hidden="true">
                                    <path
                                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>
                                </svg>
                                {{ __('Redeem Voucher') }}
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Pagination (if needed) --}}
        {{-- <div class="mt-6">{{ $wallet->transactions->links() }}</div> --}}

    </div>

    {{-- Redeem Voucher Modal --}}
    <div
        x-data="{ open: false }"
        x-show="open"
        x-on:open-redeem-voucher-modal.window="open = true"
        x-on:close-redeem-voucher-modal.window="open = false"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto"
    >
        <!-- Overlay -->
        <div
            class="fixed inset-0  bg-opacity-50 backdrop-blur-sm transition-opacity"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            aria-hidden="true"
        ></div>

        <!-- Modal Panel -->
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-6 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-6 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-xl shadow-xl w-full max-w-md mx-4 sm:mx-auto p-6 sm:p-8"
            role="dialog"
            aria-modal="true"
            aria-labelledby="voucher-modal-title"
        >
            <!-- Close Button -->
            <button
                x-on:click="open = false"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-orange rounded-full p-1"
            >
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Icon -->
            <div class="flex justify-center">
                <div class="h-12 w-12 flex items-center justify-center rounded-full bg-primary-orange-light mb-4">
                    <x-tabler-tag class="h-6 w-6 text-primary-orange"/>
                </div>
            </div>

            <!-- Title & Description -->
            <h2 id="voucher-modal-title" class="text-xl font-semibold text-gray-900 text-center mb-2">
                {{ __('Redeem Voucher Card') }}
            </h2>
            <p class="text-sm text-gray-500 text-center mb-6">
                {{ __('Enter your voucher code below to add funds to your wallet.') }}
            </p>

            <!-- Form -->
            <form action="{{ route('vouchers.redeem') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="voucher_code" class="block text-sm font-medium text-gray-700">
                        {{ __('Voucher Code') }}
                    </label>
                    <input
                        type="text"
                        name="code"
                        id="voucher_code"
                        required
                        placeholder="e.g., ABC-123-XYZ"
                        class="mt-1 block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2 shadow-sm text-gray-900 placeholder-gray-400 focus:border-primary-orange focus:ring focus:ring-primary-orange focus:ring-opacity-50 sm:text-sm transition-all"
                    >
                    @error('voucher_code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-end sm:space-x-3 space-y-3 sm:space-y-0">
                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-primary-orange text-white font-semibold rounded-xl shadow hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-primary-orange"
                    >
                        {{ __('Redeem Code') }}
                    </button>
                    <button
                        type="button"
                        x-on:click="open = false"
                        class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-white text-gray-900 font-semibold rounded-xl shadow border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-orange"
                    >
                        {{ __('Cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection
