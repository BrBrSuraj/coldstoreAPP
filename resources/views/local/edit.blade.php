<x-app-layout>
<div class="flex justify-start mt-5">
    <div class="border block rounded-lg shadow-lg bg-white text-start w-9/12">
        <div class="font-bold py-3 px-6 border-b border-gray-300">
            Update Supplier
        </div>
        <div class="p-6 w-full">
            <form method="POST" action="{{ route('users.locals.update',$local) }}">
                @csrf
                @method('PUT')
               
                
            
                <div class="mt-4 mb-6">
                    <x-input-label for="weight" :value="__('Weight')" />
                    <x-text-input type="number" step="any" id="weight" name="weight" class="block w-full" value="{{ $local->weight }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                </div>

                <div class="mt-4 mb-6">
                    <x-input-label for="rate" :value="__('Rate')" />
                    <x-text-input type="number" step="any" id="rate" name="rate" class="block w-full" value="{{ $local->rate }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                </div>

                <div class="mt-4 mb-6">
                    <x-input-label for="remark" :value="__('Remark')" />
                    <x-text-input type="text" id="remark" name="remark" class="block w-full p-2" value="{{ $local->remark }}" required
                        autofocus />
                    <x-input-error :messages="$errors->get('remark')" class="mt-2" />
                </div>
                <div class="mt-4 mr-2">
                    <x-input-label class="mx-2" for="remark" :value="__('Is credit')" />
                
                    <select name="credit" class="border-gray-200 rounded-lg md:mt-1">
                        <option disabled>select condition</option>
                        <option value="1">true</option>
                        <option value="0">false</option>
                    </select>
                    <x-input-error :messages="$errors->get('remark')" class="mt-2" />
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
