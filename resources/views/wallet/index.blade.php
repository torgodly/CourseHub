@extends('layouts.app')

@section('content')
    <div class="container min-h-[52vh] mx-auto px-4 py-8 mt-20">

        {{-- Title & Description --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">المحفظة</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                المحفظة هي مكانك لإدارة المعاملات المالية الخاصة بك. يمكنك الاطلاع على جميع المعاملات التي تمت في محفظتك
            </p>
        </div>

        <div>
            <div class="grid gap-4">
                @if ($wallet->transactions->count() > 0)
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Transaction Type</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Amount</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Description</th>

                                            </tr>
                                        </thead>

                                        @foreach ($wallet->transactions as $transaction)
                                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                                                <tr class="hover:bg-gray-100 dark:hover:bg-neutral-200">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-md font-medium text-black dark:text-neutral-700">
                                                        {{ str($transaction->type)->ucfirst() }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-md text-black dark:text-neutral-700">
                                                        {{ $transaction->amount }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-md text-black dark:text-neutral-700">
                                                        {{ $transaction->meta[0] }}</td>

                                                </tr>


                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center text-gray-500">
                        لا توجد معاملات في المحفظة بعد.
                    </div>
                @endif
            </div>
        </div>



        {{-- <div class="mt-6">{{ $favorites->links() }}</div> --}}

    </div>
@endsection
