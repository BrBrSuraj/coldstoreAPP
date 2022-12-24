<table id="paymentTable" class="table-auto w-full whitespace-no-wrap border-t-4 p-2">
    <thead class="text-center">
        <tr class="border-t text-xs font-bold tracking-wide  text-gray-500 uppercase bg-gray-200 border-b ">
            <th class="px-4 py-3">Sn</th>
            <th class="px-4 py-3">Amount</th>
            <th class="px-4 py-3">fy</th>
            <th class="px-4 py-3">received at</th>
            <th class="px-4 py-3">operations</th>
           
        </tr>
    </thead>

    <tbody class="bg-white divide-y">

        @foreach($sale_payments as $sale_payment)
        <tr class="px-4 py-3 text-gray-700">
            <td class=" text-sm border">
                {{$count=$count+1 }}
            </td>

            <td class="text-sm border">
                {{ $sale_payment->formated_amount }}
            </td>
            <td class="text-sm border">
                {{ $sale_payment->fy }}
            </td>
            <td class="text-sm border">
                {{ $sale_payment->created_diff }}
            </td>

            <td class="flex text-sm border">
            <a href="{{ route('users.customers.sale_payments.edit',['customer' => $customer, 'sale_payment' => $sale_payment]) }}"
                class="hover:bg-green-700 bg-green-500 mr-2 text-white p-1 px-3 rounded-lg pb-2">edit</a>
            
            
            
            <form method="POST"
                action="{{ route('users.customers.sale_payments.destroy',['customer' => $customer, 'sale_payment' => $sale_payment]) }}"
                class="">
                @csrf
                @method('DELETE')
                <button onClick="return confirm('Are You Sure to Delete')" value="" type="submit"
                    class="hover:bg-red-900 rounded-lg bg-red-700 px-3 text-white p-1 pb-2">delete
                </button>
            </form>
            </td>
            
        </tr>
        @endforeach


    </tbody>
</table>