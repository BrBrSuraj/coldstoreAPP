<x-app-layout>
<div class="flex justify-start mt-5">
    <div class="border block rounded-lg shadow-lg bg-white text-start w-9/12">
        <div class="font-bold py-3 px-6 border-b border-gray-300">
            Edit Received Payment
        </div>
        <div class="p-6 w-full">
            <form method="POST" action="{{ route('users.customers.sales.sale_payments.update',['customer'=>$customer,'sale'=>$sale,'sale_payment'=>$salePayment]) }}">
                @csrf
                @method('PUT')
                <div class="mt-4 mb-6">
                    <x-input-label for="amount" :value="__('Amount')" />
                        <x-text-input type="number" step="any" id="amount" name="amount" step="any" class="block w-full" value="{{ $salePayment->amount }}"
                            required autofocus />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>  
                <hr class="bg-black">
            
                <div class="mt-4 flex justify-end">
                    <x-primary-button class="block w-500">
                        {{ __('Update Payment') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
      
    </div>
</div>
 
</x-app-layout>
