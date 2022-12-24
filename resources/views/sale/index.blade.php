<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div class="block rounded-lg border shadow-lg w-64 md:w-full text-start overflow-hidden bg-gray-200">
            <div class="flex justify-between w-full bg-gray-400">
                <div class="py-3 px-2  border-gray-300 w-full font-serif font-semibold">
                    <h4 class="font-semibold">Sold to --> {{ $customer->name }}</h4>
                </div>

                <a style="" href="{{ route('users.customers.sale_payments.index',$customer) }}"
                    class="h-min mx-1 my-1 p-2 md:mx-1 md:my-1 md:mr-2 text-centre hover:bg-pink-900 text-sm bg-pink-700 text-white rounded">Received</a>
            </div>

            <div class="pl-3 md:mx-5 w-60 md:w-full">
                <form class="md:grid md:grid-cols-3 gap-4" method="POST"
                    action="{{ route('users.customers.sales.store',$customer) }}">
                    @csrf

                    <div class="md:mt-4 md:mb-6 mt-2 mb-2">
                        <x-input-label for="name" :value="__('Weight')" />

                        <x-text-input type="number" step="any" id="weight" name="weight" class="h-8 block w-full"
                            value="{{ old('weight') }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>


                    <div class="md:mt-4 md:mb-6 mt-4 mb-6">
                        <x-input-label for="name" :value="__('Rate')" />

                        <x-text-input type="number" step="any" id="rate" name="rate" class="h-8 block w-full"
                            value="{{ old('rate') }}" required autofocus />
                        <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                    </div>


                    <div class="w-24 md:mt-9">
                        <x-primary-button class="text-sm block w-500">
                            {{ __('Sale') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
     
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