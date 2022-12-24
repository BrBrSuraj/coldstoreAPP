<x-app-layout>
<div class="flex justify-start mt-5">
    <div class="border block rounded-lg shadow-lg bg-white text-start w-9/12">
        <div class="font-bold py-3 px-6 border-b border-gray-300">
            Update Payment
        </div>
        <div class="p-6 w-full">
            <form method="POST" action="{{ route('users.suppliers.payments.update',['supplier'=>$supplier,'payment'=>$payment]) }}">
                @csrf
                @method('PUT')
                <div class="mt-4 mb-6">
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input type="number" id="amount" name="amount" class="block w-full p-2" value="{{ $payment->amount }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>  
                <hr class="bg-black">
            
                <div class="mt-4 flex justify-end">
                    <x-primary-button class="block w-500">
                        {{ __('Update Previous Paid Amount') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
      
    </div>
</div>
 
</x-app-layout>
