<x-app-layout>
<div class="flex justify-start mt-5">
    <div class="border block rounded-lg shadow-lg bg-white text-start w-9/12">
        <div class="font-bold py-3 px-6 border-b border-gray-300">
            Update Customer
        </div>
        <div class="p-6 w-full">
            <form method="POST" action="{{ route('users.customers.update',$customer) }}">
                @csrf
                @method('PUT')
                <div class="mt-4 mb-6">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input type="text" id="name" name="name" class="block w-full p-2" value="{{ $customer->name }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
            
                <div class="mt-4 mb-6">
                    <x-input-label for="phone" :value="__('Phone number')" />
                    <x-text-input type="number" id="phone" name="phone" class="block w-full" value="{{ $customer->phone }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="mt-4 mb-6">
                    <x-input-label for="add" :value="__('Address')" />
                    <x-text-input type="text" id="address" name="address" class="block w-full" value="{{ $customer->address }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <hr class="bg-black">
            
                <div class="mt-4 flex justify-end">
                    <x-primary-button class="block w-500">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
      
    </div>
</div>
 
</x-app-layout>
