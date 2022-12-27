<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div>
            <div
                class="w-64 md:w-full font-serif md:max-w-full block rounded-lg border shadow-lg bg-gray-200 text-start">
                <div class="flex justify-between w-full bg-gray-400">
                    <div class="py-3 px-6  border-gray-300 w-full font-semibold font-serif uppercase">
                        <h4 class="font-semibold font-serif">Customers</h4>
                    </div>
                </div>
                <form class="mt-2 md:mx-4 mx-2 flex flex-col md:flex-row md:items-center justify-start gap-2 w-9/12" method=" POST"
                       action="{{ route('users.customers.store') }}">
                        @csrf
                    
                        <div class=" nt-2 md:w-full">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input type="text" id="name" name="name" class="block w-full p-2" value="{{ old('name') }}" required
                                autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    
                    
                        <div class=" mt-2 md:mt-0 md:w-full">
                            <x-input-label for="name" :value="__('Phone number')" />
                            <x-text-input type="number" id="phone" name="phone" class="block w-full" value="{{ old('name') }}" required
                                autofocus />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    
                    
                        <div class="mt-2 md:mt-0 md:w-full">
                            <x-input-label for="name" :value="__('Address')" />
                            <x-text-input type="text" id="address" name="address" class="block w-full" value="{{ old('name') }}" required
                                autofocus />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    
                        <div class="md:mt-5">
                            <x-primary-button class="block">
                                {{ __('create') }}
                            </x-primary-button>
                        </div>
                    
                    </form>
                <div class="overflow-x-auto w-max-auto px-4 mt-3">

                    <div class="mb-2 mt-5 overflow-x-auto">
                        <table id="supplierTable" class="table-auto w-max-auto whitespace-no-wrap border-t-4">
                            <thead>
                                <tr
                                    class="border-t text-xs font-semibold tracking-wide text-left  uppercase bg-cool-gray-400 text-gray-900 border-b">
                                    <th class="px-4 py-3">Sn</th>
                                    <th class="px-4 py-3">Name</th>

                                    <th class="px-4 py-3">Weight</th>
                                    <th class="px-4 py-3">Total Cost</th>
                                    <th class="px-4 py-3">Total Received</th>
                                    <th class="px-4 py-3">Operation</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y font-serif">
                                @foreach($customers as $customer)
                                <tr class="text-gray-700 ">

                                    <td class="border px-4 py-3 text-sm text-indigo-900 font-serif font-semibold">
                                        {{ $count=$count+1 }}
                                    </td>

                                    <td
                                        class="border px-4 py-3 text-sm text-indigo-900 font-serif font-semibold capitalize md:underline">
<div class="flex justify-between">
    <a href="{{ route('users.customers.sales.index',$customer) }}"
        class="md:bg-cool-gray-300 text-sm text-black hover:text-white px-1 py-1 rounded hover:bg-cool-gray-700">{{ $customer->name }}
    </a>
    <span
        class="w-max-auto bg-green-600 rounded-lg  p-1 text-xs md:text-white">{{ $customer->sales()->count()  
        }}</span>
</div>

                                       
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $customer->sales->sum('weight')." "."kg." }}
                                    </td>
                                    <td class="border px-4 py-3 text-sm font-semibold underline">
                                        {{ $customer->sales->totalInCurrency }}
                                    </td>
                                    <td class="border px-4 py-3 text-sm font-semibold underline">
                                        {{$customer->sale_payments->amountInCurrency}}
                                    </td>
                                    <td class="border px-4 py-3 text-sm">
                                        <div class="flex justify-start w-max-auto">
                                            <div class="bg-cool-gray-600 hover:bg-cool-gray-900  text-white 
                                            rounded-lg flex justify-between p-2 w-auto">
                                                <a href="{{ route('users.customers.sale_payments.index',$customer) }}"
                                                    class="  text-white 
                                            rounded-lg mr-2">Received dtl.
                                                </a>
                                                <span
                                                    class="w-max-auto bg-red-600 rounded-3xl p-1 w-auto text-xs text-white">{{ $customer->sale_payments()->count() }}</span>
                                            </div>

                                            <x-nav-link
                                                class="mr-1 ml-1 w-16 bg-green-600 hover:bg-green-900 text-white rounded-lg"
                                                href="{{  route('users.customers.edit',$customer)  }}"
                                                :active="request()->routeIs('users.locals.index')||request()->routeIs('users.locals.edit')">

                                                <span class="text-white text-xs">{{ __('Edit') }}</span>
                                            </x-nav-link>

                                            <x-nav-link
                                                class="mr-1 w-16 bg-purple-600 hover:bg-purple-900 text-white rounded-lg"
                                                href="{{ route('users.customers/billprint',['customer_id'=>$customer->id]) }}"
                                                :active="request()->routeIs('users.locals.index')||request()->routeIs('users.locals.edit')">

                                                <span class="text-white text-xs">{{ __('print') }}</span>
                                            </x-nav-link>





                                            <form method="POST"
                                                action="{{ route('users.customers.destroy',$customer) }}" class="">
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