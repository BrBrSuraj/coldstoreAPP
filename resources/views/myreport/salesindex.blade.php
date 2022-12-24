<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div>
            <div
                class="w-64 md:w-full font-serif md:max-w-full block rounded-lg border shadow-lg bg-gray-200 text-start">
                <div class="flex justify-between w-full">
                    <div class="py-3 px-6  border-gray-300 bg-gray-400 w-full">
                        <h4 class="font-bold uppercase">Sales Report</h4>
                    </div>
                </div>

                <div class="container mx-auto px-4 sm:px-8">
                    <div class="py-1">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                  <div class="header md:hidden">
                                    <header id="pheader" class="text-xl text-center">Bely Bridge Cold Stores & suppliers</header>
                                    <h1 class="text-xl text-center">{{ now() }}</h1>
                                  </div>
                                    <div class="overflow-hidden">
                                      <table id="sReportTable" class="display nowrap min-w-full">
                                            <thead class="text-sm bg-cool-gray-400 border-b uppercase">
                                                <tr>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Sn.
                                                    </th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        C Name
                                                    </th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        sold Weight
                                                    </th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Rate
                                                    </th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Total
                                                    </th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        paid amount
                                                    </th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Fiscal Year
                                                    </th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        sold_at </th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Payment Status </th>
                                            </thead>
                                            <tbody>
                                                @forelse ($sales as $sale)
                                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                        
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $count++ }}
                                                    </td>
                                                    <td class="bg-purple-200 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <a href="{{ route('system.salesReports.show',$sale->customer->id) }}"
                                                        class="bg-purple-200 hover:bg-purple-300 cursor-pointer px-2 py-1.5 rounded text-center">{{ $sale->customer->name }}</a>
                                        
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $sale->weight." ".'kg.' }}
                                        
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $sale->rate." ".'kg.' }}
                                        
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{$sale->total." ".'rs.' }}
                                                    </td>
                                        
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $sale->sale_payments()->sum('amount')." ".'rs.' }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $sale->fy }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $sale->created_diff }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $sale->status }}
                                                    </td>
                                        
                                                </tr>
                                                @empty
                                                <tr colspan="3">Not Found</tr>
                                                @endforelse
                                        
                                            </tbody>
                                        </table>
                                      
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="printHeader" class="md:hidden mt-10 flex flex-col md:mx-5  items-start pt-2 rounded bg-purple-100">
                <div class="text-center border-t-2 border-t-purple-300 px-1 mx-10 text-gray-900 font-semibold text-md">
                    Subash Kattel
                    <h1 class="text-gray-900 font-semibold text-md flex flex-col text-center"><span>CEO</span>Belly Bridge
                        ColdStore,<span>Naksoti-7,Hetauda,Makawanpur</span></h1>
                </div>
            
            </div>
        </div>

    </div>






</x-app-layout>