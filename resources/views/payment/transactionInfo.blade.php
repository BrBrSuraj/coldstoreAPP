<div class="md:mt-1 md:ml-6 md:mr-4 ">
    <h1 class="uppercase text-center p-1 text-lg underline font-serif md:text-3xl font-semibold mb-3 text-blue-600">
        Transaction</h1>
    <dl class="uppercase border-t max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
        <div class="flex flex-col md:pb-3 md:pt-3 p-1">
            <dt class="text-start mr-2 mb-1 text-gray-700 md:text-lg dark:text-gray-400">Total Weight
            </dt>
            <dd class="bg-red-500 p-1 rounded text-start mr-2 text-lg font-semibold">
                {{ $supplierPurchese->sum('weight')." "."kg." }}
            </dd>
        </div>
        <div class="flex flex-col md:py-3 md:pt-3 p-1">
            <dt class="text-start mr-2 mb-1 text-gray-700 md:text-lg dark:text-gray-400">Total Cost</dt>
            <dd class="bg-yellow-500 rounded p-1 text-start mr-2 text-lg font-semibold">
                {{ $supplierPurchese->sum('total')." "."rs." }}
            </dd>
        </div>
        <div class="border-b flex flex-col p-1 md:pt-3">
            <dt class="text-start mr-2 mb-1 text-gray-700 md:text-lg dark:text-gray-400">Paid Amount
            </dt>
            <dd class="bg-pink-500 p-1 rounded text-start mr-2 text-lg font-semibold">
                {{ $payments->sum('amount')." "."rs." }}
            </dd>
        </div>

    </dl>
</div>