<x-app-layout>
    <div class="flex justify-start">
        <div class="mt-4 block rounded-lg shadow-lg bg-white w-9/12 text-start">
            <div class="font-bold py-3 px-6 border-b border-gray-300">
                {{ __('Edit Sale') }}
            </div>
            <div class="p-6">
                <div class="overflow-x-auto w-full">
                 <form method="POST" action="{{ route('users.customers.sales.update',['customer'=>$customer,'sale'=>$sale]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mt-4 mb-6 mx-2">
                        <x-input-label for="weight" :value="__('Weight')" />
                        <x-text-input type="number" step="any" id="weight" name="weight" class="block w-full" value="{{ $sale->weight }}"
                            required autofocus />
                          
                        <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                    </div>
                
                
                    <div class="mt-4 mb-6 mx-2">
                        <x-input-label for="rate" :value="__('Rate')" />
                        <x-text-input type="number" step="any" id="rate" name="rate" class="block w-full" value="{{$sale->rate }}" required
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
