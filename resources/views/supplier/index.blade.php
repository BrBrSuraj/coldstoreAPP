<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div>
            <div
                class="w-64 md:w-full font-serif md:max-w-full block rounded-lg border shadow-lg bg-gray-200 text-start">
                <div class="flex justify-between w-full">
                    <div class="py-3 px-6  border-gray-300 bg-gray-400 w-full">
                        <h4 class="font-bold uppercase">Suppliers</h4>
                    </div>
                </div>
                <div class="overflow-x-auto w-max-auto px-4 mt-3">

                    <div class="w-40 md:w-full">
                        <form class="md:grid md:grid-cols-4 gap-3" method="POST"
                            action="{{ route('users.suppliers.store') }}">
                            @csrf

                            <div class="w-52 nt-2 md:w-full">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input type="text" id="name" name="name" class="h-8 block w-full p-2"
                                    value="{{ old('name') }}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>


                            <div class="w-52 mt-2 md:mt-0 md:w-full">
                                <x-input-label for="name" :value="__('Phone number')" />
                                <x-text-input type="number" id="phone" name="phone" class="block w-full h-8"
                                    value="{{ old('name') }}" required autofocus />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>


                            <div class="w-52 mt-2 md:mt-0 md:w-full">
                                <x-input-label for="name" :value="__('Address')" />
                                <x-text-input type="text" id="address" name="address" class="h-8 block w-full"
                                    value="{{ old('name') }}" required autofocus />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>


                            <div class="mt-2 md:mt-6 rounded w-24 text-md  text-center bg-purple-700 text-white h-8">

                                <button
                                    class="pt-1.5 pb-1 hover:bg-purple-900 focus:bg-indigo-600 rounded w-24 text-sm  text-center bg-purple-700 text-white">Create</button>
                            </div>
                        </form>
                    </div>



                    <div class="mb-2 mt-5 overflow-x-auto">
                        <table id="supplierTable" class="w-max-auto table-auto whitespace-no-wrap border-t-4">
                            <thead>
                                <tr
                                    class="bg-cool-gray-400 text-gray-900 border-t text-xs font-semibold tracking-wide text-left uppercase  border-b">
                                    <th class="px-4 py-3">Sn</th>
                                    <th class="px-4 py-3">Name</th>


                                    <th class="px-4 py-3">Weight</th>
                                    <th class="px-4 py-3">Total Cost</th>
                                    <th class="px-4 py-3">Total Paid</th>
                                    <th class="px-4 py-3">Operation</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y font-serif">
                                @foreach($suppliers as $supplier)
                                <tr class="text-gray-700">

                                    <td class="border px-4 py-3 text-sm text-indigo-900 font-serif font-semibold">
                                        {{ $count=$count+1 }}
                                    </td>

                                    <td
                                        class="border px-4 py-3 text-sm text-indigo-900 font-serif font-semibold capitalize text-start md:text-start">

                                        <div class="flex justify-between">
                                            <a href="{{ route('users.suppliers.purcheses.index',$supplier) }}"
                                                class="md:bg-cool-gray-300 text-sm text-black hover:text-white px-1 py-1 rounded hover:bg-cool-gray-700">{{ $supplier->name }}
                                            </a>
                                            <span
                                                class="w-max-auto bg-green-600 rounded-lg  p-1 text-xs md:text-white">{{ $supplier->purcheses()->count() }}</span>
                                        </div>

                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $supplier->purcheses->sum('weight')." "."kg." }}
                                    </td>
                                    <td class="border px-4 py-3 text-sm font-semibold underline">
                                        {{ $supplier->purcheses->totalInCurrency }}
                                    </td>
                                    <td class="border px-4 py-3 text-sm font-semibold underline">
                                        {{$supplier->payments->amountInCurrency }}
                                    </td>


                                    <td class="border px-4 py-3 text-sm">
                                        <div class="flex justify-start w-max-auto">
                                            <div
                                                class="bg-cool-gray-600 hover:bg-cool-gray-900  text-white 
                                                                                rounded-lg flex justify-between p-2 w-auto">
                                                <a href="{{ route('users.suppliers.payments.index',$supplier) }}" class="  text-white 
                                                                                rounded-lg mr-2">Paid dtl.
                                                </a>
                                                <span
                                                    class="w-max-auto bg-red-600 rounded-3xl p-1 w-auto text-xs text-white">{{ $supplier->payments()->count() }}</span>
                                            </div>

                                            <x-nav-link
                                                class="mr-1 ml-1 w-16 bg-green-600 hover:bg-green-900 text-white rounded-lg"
                                                href="{{  route('users.suppliers.edit',$supplier)  }}"
                                                :active="request()->routeIs('users.locals.index')||request()->routeIs('users.locals.edit')">

                                                <span class="text-white text-xs">{{ __('Edit') }}</span>
                                            </x-nav-link>



                                            <form method="POST"
                                                action="{{ route('users.suppliers.destroy',$supplier) }}" class="">
                                                @csrf
                                                @method('DELETE')
                                                <button onClick="return confirm('Are You Sure to Delete')" value=""
                                                    type="submit"
                                                    class="hover:bg-red-900 rounded-lg bg-red-600 text-xs text-white p-3">Delete
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

        </div>

        {{-- modal window --}}




</x-app-layout>