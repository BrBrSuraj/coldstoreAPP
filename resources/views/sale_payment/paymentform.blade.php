<form class="mx-2 flex flex-col md:flex-row gap-5 mt-2 items-start justify-start" method="POST"
    action="{{ route('users.customers.sale_payments.store',$customer) }}">
    @csrf
<div>
<select id="sale" name="sale_id"
    class="bg-gray-50 h-11 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-max-auto dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option selected>Choose a Sale</option>
    @foreach ($salesForDropDown as $sale )
    <option class="text-red-600 font-semibold" value="{{ $sale->id }}">
        {{ $sale->created_weight." "."||"." "."price: ".$sale->total." "."rs."}}<span class="text-red-600 font-bold">||
            Due:{{ $sale->saleDue() }}</span>
    </option>
    @endforeach
</select>
<x-input-error :messages="$errors->get('sale_id')" class="mt-2" />
</div>
 
    <div class="-mt-1">
        <x-text-input placeholder="amount in rs." type="number" id="amount" name="amount" step="any"
            class="block w-full" value="{{ old('amount') }}" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>


    <div class="mx-2 mt-0.5">
        <x-primary-button class="block">
            {{ __('Receive') }}
        </x-primary-button>
    </div>
</form>