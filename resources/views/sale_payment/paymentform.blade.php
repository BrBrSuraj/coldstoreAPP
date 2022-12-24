<div class="px-3 pt-2 w-60 md:w-full">
    <form class="md:grid md:grid-cols-3 md:gap-3" method="POST"
        action="{{ route('users.customers.sale_payments.store',$customer) }}">
        @csrf

        <select id="sale" name="sale_id"
            class="bg-gray-50 h-10 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choose a Sale</option>
            @foreach ($salesForDropDown as $sale )
            <option class="text-red-600 font-semibold" value="{{ $sale->id }}">
                {{ $sale->created_weight." "."||"." "."price: ".$sale->total." "."rs."}}<span
                    class="text-red-600 font-bold">|| Due:{{ $sale->saleDue() }}</span>
            </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('sale_id')" class="mt-2" />
        <div class="md:mb-6 mb-2 mt-2 md:mt-0">

            <x-text-input placeholder="amount in rs." type="number" id="amount" name="amount" step="any"
                class="h-8 block w-full p-2" value="{{ old('amount') }}" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <div class="">
            <x-primary-button class="h-9 block w-500">
                {{ __('Receive') }}
            </x-primary-button>
        </div>
    </form>
</div>