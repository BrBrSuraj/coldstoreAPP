<x-app-layout>
<div class="flex justify-start mt-5">
    <div class="border block rounded-lg shadow-lg bg-gray-200 text-start w-9/12">
        <div class="font-bold py-3 px-6 border-b bg-gray-400 border-gray-300">
            Update Supplier
        </div>
        <div class="p-6 w-full">
            <form method="POST" action="{{ route('users.suppliers.update',$supplier) }}">
                @csrf
                @method('PUT')
                <div class="mt-4 mb-6">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input type="text" id="name" name="name" class="block w-full p-2" value="{{ $supplier->name }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
            
                <div class="mt-4 mb-6">
                    <x-input-label for="phone" :value="__('Phone number')" />
                    <x-text-input type="number" id="phone" name="phone" class="block w-full" value="{{ $supplier->phone }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="mt-4 mb-6">
                    <x-input-label for="add" :value="__('Address')" />
                    <x-text-input type="text" id="address" name="address" class="block w-full" value="{{ $supplier->address }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <hr class="bg-black">
            
                <div class="mt-1 flex justify-start">
                    <x-primary-button class="block w-500">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
      
    </div>
</div>
 
</x-app-layout>
