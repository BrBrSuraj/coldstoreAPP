<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div class="block rounded-lg border shadow-lg w-64 md:w-full text-start overflow-hidden bg-gray-200">
            <div class="flex justify-between w-full bg-gray-400">
              <div class="py-3 px-2  border-gray-900 bg-gray-400 w-full flex flex-row gap-2 justify-start items-center">
                    <h4 class="font-bold text-lg ">Sales Details with</h4>
                    <span class="font-bold text-lg text-gray-900"> {{$customer->name }}</span>
                </div>
            </div>
            <div class="flex justify-between w-full items-center">
            
                <div class="py-3 px-6 items-center  border-gray-300 bg-cool-gray-400 w-full flex flex-col md:flex-row gap-10">
                    <h1 class="text-white px-2 shadow-md">INFO :</h1>
                    <h4 class="font-bold uppercase bg-teal-300 px-2 shadow-lg">Sold Weight : {{ $sales->sum('weight')." "."kg." }}
                    </h4>
                    <h4 class="font-bold uppercase bg-indigo-300 px-2 shadow-lg">Sales : {{ $sales->sum('total')." "."rs." }}</h4>
                    <h4 class="font-bold uppercase bg-green-300 px-2 shadow-lg">Received Amount :
                        {{ $sales->sum('total')." "."rs." }}</h4>

                        <a style="" href="{{ route('users.customers.sale_payments.index',$customer) }}"
                                class="bg-purple-500 px-2 py-1 rounded-lg hover:bg-purple-900 text-white">Go to Customer's Payment</a>
                </div>
            </div>

            <form class="mt-2 md:mx-3 mx-2 flex flex-col md:flex-row justify-start gap-4" method="POST"
              action="{{ route('users.customers.sales.store',$customer) }}">
                @csrf
            
                <div class="">
                    <x-text-input placeholder="Enter Weight" type="number" step="any" id="weight" name="weight" class="block w-full"
                        value="{{ old('weight') }}" required autofocus />
                    <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                </div>
            
            
                <div class="">
                    <x-text-input placeholder="Enter Rate" type="number" step="any" id="rate" name="rate" class="block w-full"
                        value="{{ old('rate') }}" required autofocus />
                    <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                </div>
            
            
                <div class="mx-1 md:mt-1">
            
                    <x-primary-button class="">
                        {{ __('Sale') }}
                    </x-primary-button>
                </div>
            </form>
     
            <div class="md:mx-4 overflow-x-auto w-max-auto mt-3 px-3">
                <table id="purcheseTable" class="w-max-auto border-t-4 p-2 font-serif">
                    <thead>
                        <tr
                            class="border-t text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-200 border-b">
                            <th class="px-4 py-3">Sn</th>
                            <th class="px-4 py-3">Weight</th>
                            <th class="px-4 py-3">Rate</th>
                            <th class="px-4 py-3">price</th>
                            <th class="px-4 py-3">fy</th>

                            <th class="px-4 py-3">sold at</th>
                            <th class="px-4 py-3">Payment Status</th>
                            <th class="px-4 py-3">operation</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white  divide-gray-200 font-serif">

                        @foreach($sales as $sale)
                        <tr class="text-gray-700 ">
                            <td class="border px-2 py-2 text-sm font-serif font-semibold text-indigo-900">
                                {{$count=$count+1 }}
                            </td>

                            <td class="border px-2 py-2 text-sm font-semibold">
                                {{ $sale->formated_weight }}
                            </td>
                            <td class="border px-2  py-1 text-sm font-semibold underline">
                                {{ $sale->formated_rate}}
                            </td>
                            <td class="border px-2  py-1 text-sm font-semibold underline">
                                {{ $sale->formated_total}}
                            </td>
                            <td class="border px-2  py-1 text-sm font-semibold underline">
                                    {{ $sale->fy}}
                                </td>

                            <td class="border px-2 py-1 text-sm">
                                {{ $sale->created_diff }}
                            </td>


                            <td class="border px-2 py-1 text-sm">


                                <div class="flex space-x-2 justify-left">
                                    @if($sale->status=='completed')
                                    <button type="button"
                                        class="w-max-auto inline-block px-2 py-2 text-left bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-900 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out  items-center ">
                                        {{ $sale->status }}
                                    </button>
                                    @else
                                    <button type="button"
                                        class="w-max-auto inline-block px-2 py-2 text-left bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-900 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out  items-center ">
                                        {{ $sale->status }}
                                        <span
                                            class="inline-block py-1 px-2 leading-none text-center whitespace-nowrap align-baseline font-bold text-white rounded ml-2">{{ $sale->saleDue()." "."rs." }}
                                        </span>

                                    </button>
                                    @endif

                                </div>
                            </td>
                            <td class="border px-4 py-3 text-sm">
                                <div class="flex justify-start">
                                    <a href="
                                    {{ route('users.customers.sales.sale_payments.index',['customer' => $customer, 'sale' => $sale]) }}
                                    "
                                        class="hover:bg-indigo-900 bg-indigo-700 mr-2 text-white p-1 px-3 rounded-lg pb-2">Received
                                        money
                                    </a>

                                    <a href="
                                    {{ route('users.customers.sales.edit',['sale' => $sale,'customer' => $customer]) }}
                                    "
                                        class="hover:bg-green-700 bg-green-500 mr-2 text-white p-1 px-3 rounded-lg pb-2">edit</a>



                                    <form method="POST" action="
                                        {{ route('users.customers.sales.destroy',['customer' => $customer, 'sale' => $sale]) }}
                                        " class="">
                                        @csrf
                                        @method('DELETE')
                                        <button onClick="return confirm('Are You Sure to Delete')" value=""
                                            type="submit"
                                            class="hover:bg-red-900 rounded-lg bg-red-700 px-3 text-white p-1 pb-2">delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>


    </div>
</x-app-layout>