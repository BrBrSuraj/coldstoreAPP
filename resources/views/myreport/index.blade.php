<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div>
            <div
                class="w-64 md:w-full font-serif md:max-w-full block rounded-lg border shadow-lg bg-gray-200 text-start">
                <div class="flex justify-between w-full">
                    <div class="py-3 px-6  border-gray-300 bg-gray-400 w-full">
                        <h4 class="font-bold uppercase">Purchese Report</h4>
                    </div>
                </div>

                <div class="container mx-auto px-4 sm:px-8">
                    <div class="py-1">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">

                                    <div class="overflow-hidden">
                                        <table id="pReportTable" class="display nowrap min-w-full divide-y-0">
                                            <thead class="bg-cool-gray-400 uppercase text-white border-b">
                                                <tr>
                                                  <th scope="col" class=""></th>
                                                   
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Sn.
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        S Name
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Purchesed Weight
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Rate
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Total
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Amount Paid
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Fiscal Year
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Purchesed_at </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Payment Status </th>
                                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            </th>
                                            </thead>
                                            <tbody>
                                                @forelse ($purcheses as $purchese)
                                                <tr
                                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-200">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">

                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $count++ }}
                                                       
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 bg-teal-200">
                                                        <a href="{{ route('system.purcheseReports.show',$purchese->supplier->id) }}"
                                                            class="bg-teal-200 hover:bg-teal-500 hover:text-white cursor-pointer px-2 py-1.5 rounded text-center">{{ $purchese->supplier->name }}</a>

                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $purchese->weight." ".'kg.' }}

                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $purchese->rate." ".'kg.' }}

                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-bold px-6 py-4 whitespace-nowrap">
                                                        {{$purchese->total." ".'rs.' }}
                                                    </td>

                                                    <td
                                                        class="text-sm text-gray-900 font-bold px-6 py-4 whitespace-nowrap">
                                                        {{ $purchese->payments()->sum('amount')." ".'rs.' }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $purchese->fy }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $purchese->created_diff }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $purchese->status }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                                </tr>
                                                @empty
                                                <tr colspan="3">Not Found</tr>
                                                @endforelse

                                            </tbody>
                                            
                                        </table>
                                        {{-- <button id="printBtn" class="rounded text-sm font-semibold hover:bg-indigo-700 bg-indigo-600 px-2 py-1 text-white">print</button>
                                        <button id="excelbtn" class="rounded text-sm font-semibold hover:bg-cool-gray-700 bg-teal-500 px-2 py-1 text-white">Excel</button> --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="printHeader" class="printHeader md:hidden mt-10 flex flex-col md:mx-5  items-start pt-2 rounded bg-teal-100">
                <div class="printHeader text-center border-t-2 border-t-teal-300 px-1 mx-10 text-gray-900 font-semibold text-md">
                    Subash Kattel
                    <h1 class="printHeader text-gray-900 font-semibold text-md flex flex-col text-center"><span>CEO</span>Belly
                        Bridge
                        ColdStore,<span>Naksoti-7,Hetauda,Makawanpur</span></h1>
                </div>

            </div>
        </div>

    </div>






</x-app-layout>