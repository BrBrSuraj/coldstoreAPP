<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')


        <div class="block rounded-lg border shadow-lg bg-gray-200 w-60 md:w-full">
            <div class="md:flex md:justify-between md:w-full bg-gray-400">
                <div class="py-3 px-2  border-gray-900 bg-gray-400 w-full flex flex-row gap-2 justify-start items-center">
                    <h4 class="font-bold text-lg ">Payment Details of</h4>
                    <span class="font-bold text-lg text-gray-900"> {{ $customer->name."'s"." "."specific sale" }}</span>
                </div>

            </div>
            <div class=" w-full bg-cool-gray-400 flex flex-col md:flex-row">
                <div class="py-3 px-6  border-gray-300 w-full flex flex-col md:flex-row gap-5">
                    <h4 class="shadow-lg bg-red-500 px-2 py-1 rounded-md text-sm md:text-lg font-bold uppercase">Due Amount :{{ $sale->saleDue()." "."rs." }}
                       
                    </h4>
                    <h4 class="shadow-lg bg-green-500 px-2 py-1 rounded-md text-sm md:text-lg font-bold uppercase">Received Amount : {{ $sale_payments->sum('amount')." "."rs." }}
                     
                    </h4>
            
                </div>

                <form class="flex flex-col md:flex-row gap-2 items-start justify-start mx-6 mb-1 mt-1" method="POST"
                    action="{{ route('users.customers.sales.sale_payments.store',['customer'=>$customer,'sale'=>$sale]) }}">
                    @csrf
                
                    <div class="">
                        <x-text-input type="number" step="any" id="amount" name="amount" class="" value="{{ old('amount') }}" required
                            autofocus />
                        <x-input-error :messages="$errors->get('amount')" class="" />
                    </div>
                    <div class="mt-1">
                        <x-primary-button class="block">
                            {{ __('Pay') }}
                        </x-primary-button>
                    </div>
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
                </div>


            </div>


        </div>


    </div>
</x-app-layout>