<x-app-layout>
    <div class="flex justify-start">
        <div class="mt-4 block rounded-lg shadow-lg bg-gray-200 w-9/12 text-start">
            <div class="font-bold py-3 px-6 border-b bg-gray-400 border-gray-300">
                {{ __('Edit Purches') }}
            </div>
            <div class="p-6">
                <div class="overflow-x-auto w-full">
                 <form method="POST" action="{{ route('users.suppliers.purcheses.update',['supplier'=>$supplier,'purchese'=>$purchese]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mt-4 mb-6 mx-2">
                        <x-input-label for="name" :value="__('Weight')" />
                        <x-text-input type="number" id="weight" name="weight" step="any" class="block w-full" value="{{ $purchese->weight }}"
                            required autofocus />
                          
                        <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                    </div>
                
                
                    <div class="mt-4 mb-6 mx-2">
                        <x-input-label for="name" :value="__('Rate')" />
                        <x-text-input type="number" id="rate" name="rate" step="any" class="block w-full" value="{{$purchese->rate }}" required
                            autofocus />
                           
                        <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                    </div>
                    <hr>
                
                    <div class="mt-4 flex justify-end">
                        <x-primary-button class="block w-500">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
                </div>
    
            </div>
    
        </div>
    </div>







       

       
</x-app-layout>
