<x-app-layout>
    <div class="flex justify-center">
        <div class="mt-4 block rounded-lg shadow-lg bg-white w-full text-start">
            <div class="font-bold py-3 px-6 border-b border-gray-300">
                {{ $user->name." "."Report" }}
            </div>
            <div class="mx-auto drop-shadow rounded-md w-max-auto p-2">
                <h4 class="uppercase underline text-2xl font-italic font-semibold text-center text-black mb-4">
                    {{ $user->name." "."transaction details." }}
                </h4>

                <!-- Supplier -->
                <details class="bg-purple-400 open:bg-amber-200 duration-300">
                    <summary class="text-white bg-inherit px-5 py-3 text-lg cursor-pointer">Suppliers</summary>
                    <div class="bg-cool-gray-600 px-5 py-3 border border-gray-300 text-sm font-light">
                        @foreach ($suppliers as $supplier )
                        <ul
                            class="mt-2 mb-2 rounded-lg hover:bg-cool-gray-900 bg-cool-gray-500 text-white text-lg font-bold md:flex md:justify-start p-4 w-min-auto">

                            <a href="{{ route('admin.users/supplierPurcheses',['user_id'=>$user->id,'supplier_id'=>$supplier->id]) }}"
                                class="hover:text-xl">
                                <li class="mr-6">Name : {{ $supplier->name }}</li>
                            </a>

                            <li class="mr-6">Address : {{ $supplier->address }}</li>
                            <li class="mr-6">Phone : {{ $supplier->phone }}</li>
                        </ul>
                        @endforeach
                        <div class="text-white bg-cool-gray-200">
                            {{ $suppliers->links() }}
                        </div>
                    </div>

                </details>

                <!-- Customer -->
                <details class="mt-1 bg-blue-300 open:bg-amber-200 duration-300">
                    <summary class="bg-inherit text-white  px-5 py-3 text-lg cursor-pointer">Customer</summary>
                    <div class="bg-cool-gray-600 px-5 py-3 border border-gray-300 text-sm font-light">
                        @foreach ($customers as $customer )
                        <ul
                            class="mt-2 mb-2 rounded-lg hover:bg-cool-gray-900 bg-cool-gray-500 text-white text-lg font-bold md:flex md:justify-start p-4 w-min-auto">
                            <a href="{{ route('admin.users/customerSale',
                            ['user_id'=>$user->id,'customer_id'=>$customer->id]) }}" class="hover:text-xl">
                                <li class="mr-6">Name : {{ $customer->name }}</li>
                            </a>
                            <li class="mr-6">Address : {{ $customer->address }}</li>
                            <li class="mr-6">Phone : {{ $customer->phone }}</li>
                        </ul>
                        @endforeach
                        <div class="text-white bg-cool-gray-200">
                            {{ $customers->links() }}
                        </div>

                    </div>

                </details>

                {{-- Overall --}}
                <details class="mt-1 bg-indigo-300 open:bg-amber-200 duration-300">
                    <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">Overall Transation Report</summary>
                    <div class="bg-cool-gray-600 px-5 py-3 border border-gray-300 text-sm font-light">
                        <ul
                            class="mt-2 mb-2 rounded-lg hover:bg-cool-gray-900 bg-cool-gray-500 text-white text-lg font-bold  p-4 w-min-auto">
                            <li class="hover:bg-gray-300  hover:text-black p-2 mr-6">Total Suppliers :{{ "
                                ".$suppliers->count()}} </li>
                            <li class="hover:bg-gray-300  hover:text-black p-2 mr-6">Total Customer :{{ "
                                ".$customers->count()}} </li>
                            <li class="hover:bg-gray-300  hover:text-black p-2 mr-6">Total Purcheses Weight :{{ "
                                ".$totalPurchese."
                                "."kg." }} </li>
                            <li class="hover:bg-gray-300 hover:text-black p-2 mr-6">Total Cost of Purcheses :{{ "
                                ".$totalPurcheseCost."
                                "."rs." }} </li>
                            <li class="hover:bg-gray-300 hover:text-black p-2 mr-6">Total Paid Amount :{{ "
                                ".$totalPaid." "."rs." }}
                            </li>
                            <hr>
                            <li class="hover:bg-gray-300 hover:text-black p-2 mr-6">Total Sales Weight :{{ "
                                ".$totalSale." "."kg." }}
                            </li>
                           
                            <li class="hover:bg-gray-300 hover:text-black p-2 mr-6">Total Cost of sales :{{ "
                                ".$totalSaleAmount."
                                "."rs." }} </li>
                            <li class="hover:bg-gray-300 hover:text-black p-2 mr-6">Total Amount Received :{{ "
                                ".$totalPaymentReceived."
                                "."rs." }} </li>

                        </ul>



                    </div>
                </details>

                {{-- <details class="bg-gray-300 open:bg-amber-200 duration-300">
                        <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">Sales</summary>
                        <div class="bg-white px-5 py-3 border border-gray-300 text-sm font-light">
                            <ul>
                                <li>List Item 1</li>
                                <li>List Item 2</li>
                            </ul>
                        </div>
                    </details> --}}



            </div>
        </div>
    </div>


</x-app-layout>