<x-app-layout>
<div class="flex justify-start mt-5">
    <div class="border block rounded-lg shadow-lg bg-white text-start w-9/12">
        <div class="font-bold py-3 px-6 border-b border-gray-300">
            New Purches
        </div>
        <div class="p-6 w-full">
            <form method="POST" action="{{ route('users.suppliers.purcheses.store',$supplier) }}">
                @csrf
            
                <div class="mt-4 mb-6">
                    <x-input-label for="name" :value="__('Weight')" />
            
                        <x-text-input type="number" step="any" id="weight" name="weight" class="block w-full" value="{{ old('weight') }}" required
                            autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
            
                <div class="mt-4 mb-6">
                    <x-input-label for="name" :value="__('Rate')" />
                
                        <x-text-input type="number" step="any" id="rate" name="rate" class="block w-full" value="{{ old('rate') }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                </div>
                <hr class="bg-black">
            
                <div class="mt-4 flex justify-end">
                    <x-primary-button class="block w-500">
                        {{ __('Purches') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
      
    </div>
</div>
 
</x-app-layout>
