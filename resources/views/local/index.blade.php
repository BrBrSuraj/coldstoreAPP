<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div>
            <div
                class="w-64 md:w-full font-serif md:max-w-full block rounded-lg border shadow-lg bg-gray-200 text-start">
                <div class="flex justify-between w-full">
                    <div class="py-3 px-6  border-gray-300 bg-gray-400 w-full">
                        <h4 class="font-bold uppercase">Local Sale</h4>
                    </div>
                </div>
                <div class="overflow-x-auto w-max-auto px-4 mt-3">

                    <div class=" w-90">
                        <form class="md:flex md:justify-start" method="POST" action="{{ route('users.locals.store') }}">
                            @csrf

                            <div class="mt-4 mr-2">
                                <x-input-label class="mx-2" for="weight" :value="__('Weight')" />

                                <x-text-input type="number" step="any" id="weight" name="weight" class="block w-full"
                                    value="{{ old('weight') }}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>


                            <div class="mt-4 mr-2">
                                <x-input-label class="mx-2" for="rate" :value="__('Rate')" />

                                <x-text-input type="number" step="any" id="rate" name="rate" class="block w-full"
                                    value="{{ old('rate') }}" required autofocus />
                                <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                            </div>

                            <div class="mt-4 mr-2">
                                <x-input-label class="mx-2" for="remark" :value="__('Remark')" />

                                <x-text-input type="text" id="remark" name="remark" class="block w-full"
                                    value="{{ old('remark') }}" required autofocus />
                                <x-input-error :messages="$errors->get('remark')" class="mt-2" />
                            </div>
                            <input type="submit" value="sale"
                                class="cursor-pointer rounded-lg text-white bg-purple-700 hover:bg-purple-900 px-5 h-10 md:mt-10 mt-2 w-500">

                        </form>
                    </div>


                    <div class="mb-2 mt-5 mx-5">
                        <table id="localTable" class="table-auto w-max-auto whitespace-no-wrap border-t-4">
                            <thead>
                                <tr 
                                    class="bg-cool-gray-400 text-gray-900 border-t text-xs font-semibold tracking-wide text-left 
                                    uppercase border-b">
                                    <th class="px-4 py-3">
                                    </th>
                                    <th class="px-4 py-3">Sn</th>
                                    <th class="px-4 py-3">Remark</th>

                                    <th class="px-4 py-3">Weight</th>
                                    <th class="px-4 py-3">Rate</th>
                                    <th class="px-4 py-3">Total</th>
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
                                    <td class="border px-4 py-3 text-sm">
                                        {{ $local->remark }}
                                    </td>
                                    <td class="border px-4 py-3 text-sm">
                                        {{ $local->formated_weight}}
                                    </td>
                                    <td class="border px-4 py-3 text-sm">
                                        {{ $local->formated_rate }}
                                    </td>
                                    <td class="border px-4 py-3 text-sm">
                                        {{$local->formated_total}}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{$local->fy}}
                                    </td>
                                    <td class="border px-4 py-3 text-sm">
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
                            <tr>
                                <td colspan="3">Total</td>
                                <td class="ml-2" colspan="2">{{ $locals->sum('weight')." "."kg." }}</td>
                                <td class="ml-2">{{ $locals->sum('total')." "."rs." }}</td>
                                <td class="ml-2" colspan="3"></td>

                            </tr>
                        </table>

                    </div>





                </div>
            </div>

        </div>

        {{-- modal window --}}




</x-app-layout>