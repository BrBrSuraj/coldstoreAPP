<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')


        <div class="block rounded-lg border shadow-lg bg-gray-200 w-60 md:w-full">
            <div class="md:flex md:justify-between md:w-full bg-gray-400">
                <div class="border-gray-300 w-full p-3 font-serif">
                    <h4 class="font-semibold">Amount received from --> {{ $customer->name }} of specific sale</h4>
                </div>


            </div>
            <div class="due flex items-center justify-center p-2 text-red-700 font-bold">
                <p>Due Amount to Receive: {{ $sale->saleDue()." "."rs." }}</p>
            
            
            </div>

            <div class="md:w-full p-1 flex items-center justify-center">
                <form class="md:flex items-center px-2" method="POST"
                    action="{{ route('users.customers.sales.sale_payments.store',['customer'=>$customer,'sale'=>$sale]) }}">
                    @csrf

                    <div class="w-full">
                        <x-text-input class="md:w-full" type="number" step="any" id="amount" name="amount" class=" block"
                            value="{{ old('amount') }}" required autofocus />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>
                    <button
                        class="md:ml-3 text-sm ml-0.5  px-2 py-2 md:mt-0 mt-2 rounded bg-purple-600 text-white">Receive</button>
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
                                <th class="px-4 py-3">Received at</th>
                                <th class="px-4 py-3">operation</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @foreach($sale_payments as $payment)
                            <tr class="text-gray-700 text-lg">
                                <td class="px-4 py-3 text-sm font-semibold underline border">
                                    {{ $count=$count+1; }}
                                </td>
                                <td class="px-4 py-3  font-semibold  border">
                                    {{ $payment->formated_amount }}
                                </td>
                                <td class="px-4 py-3  font-semibold  border">
                                        {{ $payment->fy }}
                                    </td>
                                <td class="px-4 py-3 text-sm border">
                                    {{ $payment->created_diff }}
                                </td>
                                <td class="px-4 py-3 text-sm border">
                                    <div class="flex justify-start">
                                        <a href="{{ route('users.customers.sales.sale_payments.edit',['customer'=>$customer,'sale'=>$sale,'sale_payment'=>$payment]) }}"
                                            class="bg-green-500 mr-2 text-white p-1 px-3 rounded-lg pb-2">edit</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div class="underline px-3 border-t border-gray-300 text-gray-600">
                        <div class="px-4 text-lg text-green-600 font-semibold tracking-wide
                                         font-serif uppercase bg-gray-50 border-t sm:grid-cols-9">
                            Total: {{ $sale_payments->sum('amount') }}
                        </div>
                    </div>
                </div>


            </div>


        </div>


    </div>
</x-app-layout>