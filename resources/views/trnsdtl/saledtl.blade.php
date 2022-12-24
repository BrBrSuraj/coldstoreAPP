<div
    class="mt-1 md:ml-10 flex flex-col bg-cool-gray-300 border rounded-lg shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <div class="flex flex-col justify-between md:w-80 p-4 leading-normal ">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Sales Details</h5>

        <dl class="max-w-md text-gray-900 divide-y divide-gray-400 dark:text-white dark:divide-gray-700">
            <div class="flex flex-col pb-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Customer</dt>
                <dd class="text-lg font-semibold">No: {{ $customers->count() }}</dd>
            </div>
            <div class="flex flex-col py-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Sales</dt>
                <dd class="text-lg font-semibold">No: {{ $sales->count() }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Weight</dt>
                <dd class="text-lg font-semibold">{{  $sales->sum('weight')." "."kg." }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Cost</dt>
                <dd class="text-lg font-semibold">{{formatedNumber($sales->sum('total')) }}</dd>
            </div>

            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Amount Received</dt>
                <dd class="text-lg font-semibold">{{formatedNumber($sale_payments->sum('amount'))  }}
                    </li>
                </dd>
            </div>
        </dl>
    </div>
</div>