<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-50">
        @include('status.status')

        <div>
            <div
                class="w-64 md:w-full font-serif md:max-w-full block rounded-lg border shadow-lg bg-gray-200 text-start">
                <div class="flex justify-between w-full">
                    <div class="py-3 px-6  border-gray-300 bg-gray-400 w-full">
                        <h4 class="font-bold uppercase">Supplier Payment Report</h4>
                    </div>
                </div>

                <div class="container mx-auto px-2 sm:px-8">
                    <div class="py-5">
                        <div class="flex flex-col md:flex-row flex-start items-center gap-3">
                            <h2 class="text-xl md:ml-16 font-semibold leading-tight flex justify-start"><span
                                    class="font-bold uppercase text-green-900 underline"> {{ $suppliers->name }} </span>

                        </div>
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="overflow-hidden">
                                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">

                                            <div class="overflow-hidden">
                                                <table id="supplierPaymentReportTable"
                                                    class="display nowrap min-w-full">
                                                    <thead class="bg-gray-200 border-b">
                                                        <tr>
                                                            <th scope="col"
                                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                Sn.
                                                            </th>
                                                            <th scope="col"
                                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                Amount
                                                            </th>



                                                            <th scope="col"
                                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                Fiscal Year
                                                            </th>

                                                            <th scope="col"
                                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                pay_at
                                                            </th>


                                                    </thead>
                                                    <tbody>
                                                        @forelse ($suppliers->payments as $payment)
                                                        <tr
                                                            class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">

                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                {{ $count++ }}
                                                            </td>

                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $payment->amount." ".'rs.' }}

                                                            </td>

                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $payment->fy }}
                                                            </td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $payment->created_diff }}
                                                            </td>

                                                        </tr>
                                                        @empty
                                                        <tr colspan="3">Not Found</tr>
                                                        @endforelse

                                                    </tbody>
                                                </table>
                                                <div id="supplierInfo" class="mt-2 mx-2 font-semibold font-sans">
                                                    {{ "Payment Statement of"." ".$suppliers->name }}
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="printHeader" class="md:hidden mt-10 flex flex-col md:mx-5  items-start pt-2 rounded bg-teal-100">
                    <div
                        class="text-center border-t-2 border-t-teal-300 px-1 mx-10 text-gray-900 font-semibold text-md">
                        Subash Kattel
                        <h1 class="text-gray-900 font-semibold text-md flex flex-col text-center"><span>CEO</span>Belly
                            Bridge
                            ColdStore,<span>Naksoti-7,Hetauda,Makawanpur</span></h1>
                    </div>

                </div>
            </div>
        </div>

    </div>






</x-app-layout>