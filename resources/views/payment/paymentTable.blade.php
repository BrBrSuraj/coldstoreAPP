<table id="paymentTable" class="w-full whitespace-no-wrap border-t-4 p-2">
    <thead class="text-center">
        <tr class="border-t text-xs font-bold tracking-wide  text-gray-500 uppercase bg-gray-200 border-b">
            <th class="px-4 py-3">Sn</th>
            <th class="px-4 py-3">Amount</th>
            <th class="px-4 py-3">fy</th>
            <th class="px-4 py-3">Paid at</th>
            <th class="px-4 py-3">operation</th>
        </tr>
    </thead>

    <tbody class="bg-white divide-y">

        @foreach($payments as $payment)
        <tr class="text-gray-700 text-center">
            <td class="border px-4 py-3 text-sm">
                {{$count=$count+1 }}
            </td>

            <td class="border px-4 py-3 text-sm">
                {{ $payment->formated_amount }}
            </td>
            <td class="border px-4 py-3 text-sm">
                {{ $payment->fy }}
            </td>
            <td class="border px-4 py-3 text-sm">
                {{ $payment->created_diff }}
            </td>
            <td class="border px-4 py-3 text-sm">
                <div class="flex justify-start">
                    <a href="{{ route('users.suppliers.payments.edit',['supplier'=>$supplier,'payment'=>$payment]) }}"
                        class="bg-green-500 mr-2 text-white p-1 px-3 rounded-lg pb-2">edit</a>
                </div>
            </td>
        </tr>
        @endforeach


    </tbody>
</table>