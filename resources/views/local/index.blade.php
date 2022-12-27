<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xl sm:w-50">
        @include('status.status')

        <div>
            <div
                class="w-64 md:w-full font-serif md:max-w-full block rounded-lg border shadow-lg bg-gray-200 text-start">
                <div class="flex justify-between w-full">
                    <div class="py-3 px-6  border-gray-300 bg-gray-400 w-full">
                        <h4 class="font-bold uppercase">Local Sale</h4>
                    </div>
                </div>
                <div class="flex justify-between w-full md:items-center">

                    <div
                        class="py-3 px-6 md:items-center  border-gray-300 bg-cool-gray-400 w-full flex flex-col md:flex-row gap-10">
                        <h1 class="text-white px-2 shadow-md">INFO :</h1>
                        <h4 class="font-bold uppercase bg-teal-300 px-2 shadow-lg">Sold Weight :
                            {{ $locals->sum('weight')." "."kg." }}</h4>
                        <h4 class="font-bold uppercase bg-indigo-300 px-2 shadow-lg">Sales :
                            {{ $locals->sum('total')." "."rs." }}</h4>
                        <h4 class="font-bold uppercase bg-green-300 px-2 shadow-lg">Received Amount :
                            {{ $locals->where('credit',0)->sum('total')." "."rs." }}</h4>
                        <h4 class="font-bold uppercase bg-red-300 px-2 shadow-lg">Credited :
                            {{ $locals->where('credit',1)->sum('total')." "."rs."." ".$locals->where('credit','1')->count() }}</h4>
                    </div>
                </div>
                <form class="md:mx-9 mx-3 flex flex-col md:flex-row justify-start md:items-center gap-2" method="POST"
                            action="{{ route('users.locals.store') }}">
                            @csrf
                        
                            <div class="mt-4 mr-2">
                        
                                <x-text-input type="number" step="any" id="weight" name="weight" class="block w-full"
                                    value="{{ old('weight') }}" required autofocus />
                                <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                            </div>
                        
                        
                            <div class="mt-4 mr-2">
                        
                        
                                <x-text-input type="number" step="any" id="rate" name="rate" class="block w-full" value="{{ old('rate') }}"
                                    required autofocus />
                                <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                            </div>
                            <div class="mt-4 mr-2">
                                <select name="credit" class="border-gray-200 rounded-lg md:mt-1">
                                    <option disabled>select payment status</option>
                                    <option value="1">Credit</option>
                                    <option value="0">Cash</option>
                                </select>
                                <x-input-error :messages="$errors->get('credit')" class="mt-2" />
                            </div>
                            <div class="mt-4 mr-2">
                        
                        
                                <x-text-input type="text" id="remark" name="remark" class="block w-full" value="{{ old('remark') }}" required
                                    autofocus />
                                <x-input-error :messages="$errors->get('remark')" class="mt-2" />
                            </div>
                        
                            <div class="mt-4">
                                <x-primary-button class="block">
                                    {{ __('sale') }}
                                </x-primary-button>
                            </div>
                        
                        </form>
                <div class="overflow-x-auto w-max-auto px-4 mt-3">
                    <div class="mb-2 mt-5 mx-5">
                        <table id="localTable" class="table-auto w-max-auto whitespace-no-wrap border-t-4">
                            <thead>
                                <tr class="bg-cool-gray-400 text-gray-900 border-t text-xs font-semibold tracking-wide text-left 
                                    uppercase border-b">
                                    <th class="px-4 py-3">
                                    </th>
                                    <th class="px-4 py-3">Sn</th>
                                    <th class="px-4 py-3">Remark</th>

                                    <th class="px-4 py-3">Weight</th>
                                    <th class="px-4 py-3">Rate</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">is_credited</th>
                                    <th class="px-4 py-3">fy</th>
                                    <th class="px-4 py-3">date</th>
                                    <th class="px-4 py-3">Operation</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                @foreach($locals as $local)
                                <tr class="text-gray-700">
                                    <td class="border px-4 py-3 text-sm text-indigo-900 font-semibold">

                                    </td>
                                    <td class="border px-4 py-3 text-sm text-indigo-900 font-semibold">
                                        {{ $count=$count+1 }}
                                    </td>
                                  
                                    <td class="border px-4 py-3">
                                  
                                        @if($local->credit==1)
                                        <h4 class="bg-red-400 rounded text-bold text-white px-2 py-1">{{ $local->remark }}</h4>
                                        @else
                                        <h4 class="bg-green-400 rounded text-bold text-white px-2 py-1">{{ $local->remark }}</h4>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-3">
                                        {{ $local->formated_weight}}
                                    </td>
                                    <td class="border px-4 py-3">
                                        {{ $local->formated_rate }}
                                    </td>
                                    <td class="border px-4 py-3">
                                        {{$local->formated_total}}
                                    </td>
                                    <td class="border px-4 py-3">
                                        {{$local->credit ? "Credited":"Paid"}}
                                        <h1></h1>
                                    </td>
                                    <td class="border px-4 py-3">
                                        {{$local->fy}}
                                    </td>
                                    <td class="border px-4 py-3">
                                        {{$local->created_at}}
                                    </td>
                                    <td id="operation" class="border px-4 py-3 text-sm">
                                        <div class="flex justify-start w-max-auto">
                                            <a href="{{ route('users.locals.edit',$local) }}"
                                                class="bg-green-600 hover:bg-green-900 text-white mr-2 p-1 px-3 rounded-lg pb-2">edit</a>

                                            <form method="POST" action="{{ route('users.locals.destroy',$local) }}"
                                                class="">
                                                @csrf
                                                @method('DELETE')
                                                <button onClick="return confirm('Are You Sure to Delete')" value=""
                                                    type="submit"
                                                    class="hover:bg-red-900 rounded-lg bg-red-600 px-3 text-white p-1 pb-2">Delete
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