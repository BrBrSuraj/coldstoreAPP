<div class="py-1 px-2 border-t border-gray-300 text-white">
    <div class="px-1 text-xs font-semibold tracking-wide uppercase bg-gray-50 border-t sm:grid-cols-9">


        @if($supplier->supplierDue())
        <div class="bg-red-700 rounded border-b flex flex-col pt-1">
            <dt class=" px-2 text-start mr-2 mb-1 text-white md:text-sm dark:text-gray-400">
                Due Amount
            </dt>
            <dd class="px-2 text-start mr-2 text-sm font-semibold">
                {{ $supplier->supplierDue()." "."rs." }}
            </dd>
        </div>
        @elseif(!$supplier->supplierDue())
        <div class="bg-green-600 border-b  pt-1 rounded-lg p-2">
            <dt class="underline uppercase text-start mr-2 mb-1 text-white md:text-sm">
                Payment Status
            </dt>
            <dd class="text-start text-xs">
                {{ "All purcheses payments has cleared till now ." }}
            </dd>
        </div>
        @endif

    </div>
</div>