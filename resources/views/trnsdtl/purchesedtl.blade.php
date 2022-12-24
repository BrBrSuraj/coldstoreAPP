<div
    class="mt-1 bg-cool-gray-300 border rounded-lg shadow-md md:flex-row md:max-w-xl hover:bg-white dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

    <div class="flex flex-col justify-between md:w-80 p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Purcheses Details</h5>

        <dl class="max-w-md text-gray-900 divide-y divide-gray-400 dark:text-white dark:divide-gray-700">
            <div class="flex flex-col pb-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Suppliers</dt>
                <dd class="text-lg font-semibold">No: {{  $suppliers->count() }}</dd>
            </div>
            <div class="flex flex-col py-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Purchese</dt>
                <dd class="text-lg font-semibold">No: {{ $purcheses->count() }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Weight</dt>
                <dd class="text-lg font-semibold">{{ $purcheses->sum('weight')." "."kg." }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Cost</dt>
                <dd class="text-lg font-semibold">{{ formatedNumber($purcheses->sum('total')) }}</dd>
            </div>

            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Total Amount Paid</dt>
                <dd class="text-lg font-semibold">{{ formatedNumber($payments->sum('amount')) }}
                    </li>
                </dd>
            </div>
        </dl>
    </div>
</div>