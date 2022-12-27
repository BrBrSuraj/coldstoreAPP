<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs md:w-full w-50">
        @include('status.status')


        <div class="block rounded-lg border shadow-lg bg-gray-200 w-60 md:w-full">
            <div class="flex justify-between w-full bg-gray-400">
                <div class="py-3 px-2  border-gray-900 bg-gray-400 w-full flex flex-row gap-2 justify-start items-center">
                    <h4 class="font-bold text-lg ">Payment Details of</h4>
                    <span class="font-bold text-lg text-gray-900"> {{ $customer->name }}</span>
                </div>
            </div>
            <div class="flex flex-col md:flex-row w-full bg-cool-gray-400">
                <div class="py-3 px-2  border-gray-300 w-full flex flex-col md:flex-row gap-5">
                    <h4 class="font-semibold uppercase shadow-lg text-white px-1 py-1">Info</h4>
                    <h4 class="font-semibold uppercase bg-red-500 px-2 py-1 shadow-lg rounded">Due Amount : {{ $customer->customerDue() }}</h4>
                    <h4 class="font-semibold uppercase bg-green-500 px-2 py-1 shadow-lg rounded">Received Amount : {{ $sale_payments->sum('amount')." "."rs" }}</h4>
                </div>
            </div>
      
            @include('sale_payment.paymentform')
          


            <div class="md:grid md:grid-cols-3 mb:mb-4">
                <div class="overflow-x-auto w-max-auto mt-2 px-2 col-span-2">
                    @include('sale_payment.paymentTable')

                </div>

                @include('sale_payment.transactionInfo')


            </div>


        </div>


    </div>
</x-app-layout>