<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div class="bg-gray-200">
            <div class="block rounded-lg border shadow-lg bg-gray-300 md:w-full">
                <div class=" w-full bg-gray-400">
                    <div class="py-3 px-6  border-gray-300 w-full">
                        <h4 class="text-sm md:text-lg font-bold">Paid to --> {{ $supplier->name." " }}of specific
                            purchese</h4>
                    </div>
                </div>
            </div>
            <div class="md:text-center  border-gray-300 w-full p-1 rounded-lg">
                <h4 class="px-3 p-1 flex justify-center item-center font-serif font-semibold text-red-600">Due Amount to Pay:
                    {{ $purchese->purchesesDue()." "."rs." }}
                  
                </h4>

                <div class="ml-2 mr-2 w-full flex justify-center md:justify-center">
                    <form class="md:flex items-center justify-between text-start" method="POST"
                        action="{{ route('users.suppliers.purcheses.payments.store',['supplier'=>$supplier,'purchese'=>$purchese]) }}">
                        @csrf
                        <div class="">
                            <x-text-input type="number" step="any" id="amount" name="amount" class="mr-1" value="{{ old('amount') }}"
                                required autofocus />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>
                        <button class="items-center px-4 pb-2 pt-1  ml-1 md:mt-0 mt-2 h-auto rounded bg-purple-600 text-white">Pay</button>
                    </form>
                </div>



                <div class="grid mb-4">
                    <div class="overflow-x-auto w-full col-span-2 mt-1 p-3">
                        <table id="paymentTable" class="w-max-auto p-2 border-t-4 whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="border-t text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-200 border-b">
                                    <th class="px-4 py-3">Sn</th>
                                    <th class="px-4 py-3">Amount</th>
                                    <th class="px-4 py-3">fy</th>
                                    <th class="px-4 py-3">Paid at</th>
                                    <th class="px-4 py-3">operation</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                @foreach($payments as $payment)
                                <tr class="text-gray-700 text-lg text-start">
                                    <td class="border px-4 py-3 text-sm font-semibold">
                                        {{ $count=$count+1; }}
                                    </td>
                                    <td class="border px-4 py-3  font-semibold ">
                                        {{ $payment->formated_amount }}
                                    </td>
                                    <td class="border px-4 py-3  font-semibold">
                                        {{ $payment->fy }}
                                    </td>
                                    <td class="border px-4 py-3 text-sm">
                                        {{ $payment->created_diff }}
                                    </td>
                                    <td class="border px-4 py-3 text-sm">
                                        <div class="flex justify-start">
                                            <a href="{{ route('users.suppliers.purcheses.payments.edit',['supplier'=>$supplier,'purchese'=>$purchese,'payment'=>$payment]) }}"
                                                class="bg-green-500 mr-2 text-white p-1 px-3 rounded-lg pb-2">edit</a>

                                            <form method="POST"
                                                action="{{ route('users.suppliers.purcheses.payments.destroy',['supplier'=>$supplier,'purchese'=>$purchese,'payment'=>$payment]) }}"
                                                class="">
                                                @csrf
                                                @method('DELETE')
                                                <button onClick="return confirm('Are You Sure to Delete')" value=""
                                                    type="submit"
                                                    class="rounded-lg bg-red-800 px-3 text-white p-1 pb-2">delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div class="underline px-3 border-t border-gray-300 text-gray-600">
                            <div class="flex justify-start px-4 text-lg text-green-600 font-semibold tracking-wide
                                         font-serif uppercase bg-gray-50 border-t sm:grid-cols-9">
                                Total: {{ $payments->sum('amount') }}
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>

    </div>
</x-app-layout>