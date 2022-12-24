<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Coldstore Sales Invoce Print</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    </head>

    <body id="body">
<div class="flex justify-center bg-gray-100 p-2">
    <button onClick="printbill()"
        class="px-4 py-2 mr-2   bg-green-100 hover:bg-green-600 hover:text-gray-200">Print</button>

    <a href="{{ route('users.customers.index',$customer) }}"
        class="px-4 py-2 hover:bg-red-600 hover:text-gray-200  bg-red-100">Back</a>
</div>


        {{-- printArea --}}
        <div id="printable" class=" flex items-center justify-center min-h-screen bg-gray-100">
            <div class="w-3/5 bg-white shadow-lg">
                <div class="flex justify-between p-4">
                    <div>
                        <h1 class="text-3xl italic font-extrabold tracking-widest text-indigo-500">Bely Bridge Cold
                            store & Suppliers</h1>
                        <p class="text-base">If payment is not done within 7 days the credits details supplied as
                            confirmation.</p>
                    </div>

                    
                    <div class="p-2">
                        <ul class="flex">

                            <li class="flex flex-col p-2 border-l-2 border-indigo-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">
                                    Hetauda 7,Nagsoti,belly bridge
                                </span>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <p class="ml-9 font-semibold">Date: {{ today()->format('Y/M/d') }}</p>
                <div class="w-full h-0.5 bg-indigo-500"></div>
                <div class="flex justify-between p-4 mx-2">
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold"> Billed To : </span>
                            {{ $customer->name."," }}
                            {{ $customer->address."," }}
                            nepal,
                            ph:{{ " ".$customer->phone }}
                        </address>
                    </div>

                    <div class="w-72">
                        <address class="text-sm">
                            <span class="font-bold"> Issued From : </span>
                            Bely bridge cold store & Suppliers
                            Hetauda,ward-7,naksoti,Bely bridge,
                            nepal,
                            P: 9855077183/9855085870
                        </address>
                    </div>


                </div>
                <div class=" p-4">
                    <div class="border-b border-gray-200 shadow">
                        <table class="table-auto w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        SN
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Weight
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Rate
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Date
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Total
                                    </th>



                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($sales as $sale )
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        1
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{$sale->formated_weight}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">{{$sale->formated_rate}}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{$sale->created_diff}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{$sale->formated_total}}
                                    </td>


                                </tr>
                                @endforeach

                                <div class="">
                                    <tr class="">
                                        <td colspan="3"></td>
                                        <td class="text-sm font-bold">Total</td>
                                        <td class="text-sm font-bold tracking-wider"><b>{{ $sales->sum('total') }}</b>
                                        </td>
                                    </tr>

                                    <tr class="">
                                        <td colspan="3"></td>
                                        <td class="text-sm font-bold">Paid Amount</td>
                                        <td class="text-sm font-bold tracking-wider"><b>{{ $paidAmount }}</b></td>
                                    </tr>

                                    <tr class="">
                                        <td colspan="3"></td>
                                        <td class="text-sm font-bold border-t-2">Grand Total</td>
                                        <td class="border-t-2 text-sm font-bold tracking-wider">
                                            <b>{{ $sales->sum('total')-$paidAmount }}</b>
                                        </td>
                                    </tr>
                                </div>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-between p-4 mt-2 mx-2">
                    <div>
                        <h3 class="text-xl font-semibold underline mb-1">For Instant Payment :</h3>
                        <ul>
                            <li>Esewa id : 9855077183/9855043870 </li>
                            <li>Bank name : Global IME Bank </li>
                            <li>Account holder name : subash kattel </li>
                            <li>Account number : ....... </li>
                        </ul>
                    </div>


                    <div class="p-2 pb-0 mt-16">

                        <div class="italic text-md text-indigo-500 border-t-2 px-4">Subash Kattel</div>
                        <div class="font-semibold text-md text-center text-indigo-500">Propiter</div>
                    </div>
                </div>
                <div class="w-full h-0.5 bg-indigo-500"></div>
            </div>
           
        </div>
     

        <script>
            function printbill(){
                let body=document.getElementById('body').innerHTML;
                let printArea=document.getElementById('printable').innerHTML;
                document.getElementById('body').innerHTML=printArea;
                              window.print();
                              document.getElementById('body').innerHTML=body;
                            }
        </script>
    </body>


</html>