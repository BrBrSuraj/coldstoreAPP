<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs md:w-full w-50">
        @include('status.status')


        <div class="block rounded-lg border shadow-lg bg-gray-200 w-60 md:w-full">
            <div class="flex justify-between w-full bg-gray-400">
                <div class="py-3 px-2  border-gray-300 w-full">
                    <h4 class="font-semibold">Amount received from --> {{ $customer->name }}</h4>
                </div>
            </div>
            @include('sale_payment.dueInfo')
            @include('sale_payment.paymentform')
            <div class=" md:flex md:justify-start items-center px-3 w-full">
                <select id="fiscalYear"
                    class="bg-gray-50 border mr-2 md:-mt-1 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-2 block w-56 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a fiscal year</option>
                    <option value="US">United States</option>
                </select>

                <button class="ml-1 text-sm px-2 py-2 md:mt-1 mt-2  rounded-lg bg-green-600 text-white">Search</button>
            </div>


            <div class="md:grid md:grid-cols-3 mb:mb-4">
                <div class="overflow-x-auto w-max-auto mt-2 px-2 col-span-2">
                    @include('sale_payment.paymentTable')

                </div>

                @include('sale_payment.transactionInfo')


            </div>


        </div>


    </div>
</x-app-layout>