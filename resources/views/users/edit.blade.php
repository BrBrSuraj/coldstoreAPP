<x-app-layout>
    <div class="flex justify-start">
        <div class="mt-4 block rounded-lg shadow-lg bg-white w-11/12 text-start">
            <div class="font-bold py-3 px-6 border-b border-gray-300">
                {{ __('Edit User') }}
            </div>
            <div class="p-6">
                <div class="overflow-x-auto w-10/12">
                   <form method="POST" action="{{ route('admin.users.update',$user) }}">
                    @csrf
                    @method('PUT')
                
                    <div class="mt-4 mb-6 ml-1 mr-1">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input  type="text"  name="name" class="block w-full" value="{{ $user->name }}" required
                            autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                  
                
                    <div class="mt-4 mb-6 ml-1 mr-1">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input name="email" type="email" class="block w-full" value="{{ $user->email }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                   
                
                    <div class="mt-4 mb-6 ml-1 mr-1">
                        <x-input-label for="name" :value="__('Phone number')" />
                        <x-text-input type="number"  name="phone" class="block w-full" value="{{ $user->phone }}" required
                            autofocus />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                   
                
                    <div class="mt-4 mb-6 ml-1 mr-1">
                        <x-input-label for="name" :value="__('Address')"/>
                        <x-text-input type="text" name="address" class="block w-full" value="{{ $user->address }}" required
                            autofocus />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                    
                
                    <div class="mt-4 mb-6 ml-1 mr-1">
                        <x-input-label class="mb-3" for="role" :value="__('Role')"/>
                        <select id="purchese" name="role_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="{{ $user->role_id }}">{{ $user->role->name }}</option>
                         @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('purchese_id')" class="mt-2" />
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
    </div>







       

       
</x-app-layout>
