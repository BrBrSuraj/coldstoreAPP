<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div class="block rounded-lg border shadow-lg bg-gray-200 w-64 md:w-full text-start overflow-hidden">
            <div class="flex justify-between w-full">
                <div class="py-3 px-2  border-gray-300 bg-gray-400 w-full">
                    <h4 class="font-bold">Purches with --> {{ " ".$supplier->name }}</h4>
                </div>
                <div class="bg-gray-400">
                    <a style="" href="{{ route('users.suppliers.payments.index',$supplier) }}" class="h-8 my-4 mx-2 p-3 md:mx-1 md:my-1
                        md:mr-2 text-centre hover:bg-pink-900 text-sm bg-pink-700 text-white rounded">Payment</a>
                </div>
               

            </div>

            <div class="pl-3 w-60 md:w-full">
                <form class="md:grid md:grid-cols-3 gap-4" method="POST"
                    action="{{ route('users.suppliers.purcheses.store',$supplier) }}">
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
                            {{ __('Purches') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class=" overflow-x-auto w-max-auto mt-3 px-3">
                <table id="purcheseTable" class="w-max-auto border-t-4 p-2 font-serif">
                    <thead>
                        <tr
                            class="border-t text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-200 border-b">
                            <th class="px-4 py-3">Sn</th>
                            <th class="px-4 py-3">Weight</th>
                            <th class="px-4 py-3">Rate</th>
                            <th class="px-4 py-3">price</th>
                            <th class="px-4 py-3">fy</th>

                            <th class="px-4 py-3">Purchesed at</th>
                            <th class="px-4 py-3">Payment Status</th>
                            <th class="px-4 py-3">operation</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white  divide-gray-200 font-serif">

                        @foreach($purcheses as $purchese)
                        <tr class="border text-gray-700">
                            <td class="border px-2 py-2 text-sm font-serif font-semibold text-indigo-900">
                                {{$count=$count+1 }}
                            </td>

                            <td class="border px-2 py-2 text-sm font-semibold">
                                {{ $purchese->formated_weight }}
                            </td>
                            <td class="border px-2  py-1 text-sm font-semibold underline">
                                {{ $purchese->formated_rate}}
                            </td>
                            <td class="border px-2  py-1 text-sm font-semibold underline">
                                {{ $purchese->formated_total }}
                            </td>

                            <td class="border px-2  py-1 text-sm">
                                {{ $purchese->fy}}
                            </td>

                            <td class="border px-2 py-1 text-sm">
                                {{ $purchese->created_diff }}
                            </td>


                            <td class="border">


                                <div class="flex space-x-2 justify-left">
                                    @if($purchese->status=='complete')
                                    <button type="button"
                                        class="w-max-auto inline-block px-2 py-2 text-left bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-900 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out  items-center ">
                                        {{ $purchese->status }}
                                    </button>
                                    @else
                                    <button type="button"
                                        class="w-max-auto inline-block px-2 py-2 text-left bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-900 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out  items-center ">
                                        {{ $purchese->status }}
                                        <span
                                            class="inline-block py-1 px-2 leading-none text-center whitespace-nowrap align-baseline font-bold text-white rounded ml-2">{{ $purchese->purchesesDue() }}
                                        </span>

                                    </button>
                                    @endif

                                </div>
                            </td>
                            <td class="border px-4 py-3 text-sm">
                                <div class="flex justify-start">
                                    <a href="{{ route('users.suppliers.purcheses.payments.index',['supplier' => $supplier, 'purchese' => $purchese]) }}"
                                        class="hover:bg-indigo-900 bg-indigo-700 mr-2 text-white p-1 px-3 rounded-lg pb-2">pay
                                    </a>

                                    <a href="{{ route('users.suppliers.purcheses.edit',['supplier' => $supplier, 'purchese' => $purchese]) }}"
                                        class="hover:bg-green-700 bg-green-500 mr-2 text-white p-1 px-3 rounded-lg pb-2">edit</a>



                                    <form method="POST"
                                        action="{{ route('users.suppliers.purcheses.destroy',['supplier' => $supplier, 'purchese' => $purchese]) }}"
                                        class="">
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