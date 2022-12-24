<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @if ($message = Session::get('status'))
        <div class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-green-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="text-sm text-gray-600">{{ $message }}</p>
                </div>
            </div>
        </div>
        @endif

        <div>
            <div class="block rounded-lg border shadow-lg bg-white w-full">
                <div class="flex justify-between w-full">
                    <div class="py-3 px-6  border-gray-300 w-full">
                        <h4 class="font-bold">Paid to {{ $supplier->name }}</h4>
                    </div>

                    <div class="mt-2 mb-3 px-2">
                        <a href="{{ route('users.suppliers.payments.create',$supplier) }}"
                            class="px-2 py-1 pb-2 bg-purple-600 text-white rounded text-md">{{ __('create') }}</a>
                    </div>
                </div>
<div class="columns-2">
<div class="overflow-x-auto w-full">
    <div class="columns">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="border-t text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Paid at</th>

                    {{-- <th class="px-4 py-3">operation</th> --}}
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @foreach($payments as $payment)
                <tr class="text-gray-700">

                    <td class="px-4 py-3 text-sm">
                        {{ $payment->amount }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $payment->created_diff }}
                    </td>
                    {{-- <td class="px-4 py-3 text-sm">
                                    <div class="flex justify-start">

                                        <a href="{{ route('users.suppliers.purcheses.index',$supplier) }}"
                    class="bg-black text-white mr-2 p-1 px-3 rounded-lg pb-2">purches list</a>
                    <a href="{{ route('users.suppliers.show',$supplier) }}"
                        class="bg-indigo-700 mr-2 text-white p-1 px-3 rounded-lg pb-2">payment</a>
                    <form method="POST" action="{{ route('users.suppliers.destroy',$supplier) }}" class="">
                        @csrf
                        @method('DELETE')
                        <button onClick="return confirm('Are You Sure to Delete')" value="" type="submit"
                            class="rounded-lg bg-red-900 px-3 text-white p-1 pb-2">delete
                        </button>
                    </form>

    </div>
    </td> --}}
    </tr>
    @endforeach


    </tbody>
    </table>


</div>

</div>

   

                


            </div>
            <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                <div class="px-4 py-3 text-xs font-semibold tracking-wide
                         text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                    {{-- {{ $payments->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    </div>
</x-app-layout>