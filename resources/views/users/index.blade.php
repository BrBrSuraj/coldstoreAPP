<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs sm:w-30">

        @include('status.status')

        <div>
            <div class="block rounded-lg border shadow-lg bg-gray-200 w-60 md:w-full text-start">
                <div class="flex justify-between w-full bg-gray-400">
                    <div class="py-3 px-6  border-gray-300 w-full">
                        <h4 class="font-bold uppercase ">Users</h4>
                    </div>

                    <div class="md:mt-2 md:mb-3 md:px-2 ml-4 mt-4 mr-1">
                        <a href="{{ route('admin.users.create') }}" class="">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor"
                                class="w-8 h-8 text-purple-600 hover:text-purple-900 ">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z"
                                    clip-rule="evenodd" />create
                            </svg>
                        </a>
                    </div>

                </div>


                <div class="overflow-x-auto w-max-auto  p-3 mx-10 mt-5">
                    <table id="myTable" class="w-full table-auto overflow-hidden whitespace-no-wrap border-t-4">
                        <thead class="border-t bg-cool-gray-500 border-b">
                            <tr 
                                class="border-t bg-cool-gray-400 text-xs font-semibold tracking-wide text-left text-gray-900 uppercase border-b">
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Phone</th>
                                <th class="px-4 py-3">operation</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    <span
                                        class="@if($user->role->name=='admin') bg-green-500 @else bg-yellow-500 @endif p-2 rounded text-center text-white">{{ $user->role->name }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->phone }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex flex-col md:flex-row justify-start items-center">

                                        <a href="{{ route('admin.users.edit',$user) }}"
                                            class=" text-cool-gray-800 ">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="w-5 h-5">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                            </svg></a>

                                        <a href="{{ route('admin.users.show',$user) }}" class="">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-5 h-5 text-purple-500 mx-2">
                                                <path
                                                    d="M5.625 3.75a2.625 2.625 0 100 5.25h12.75a2.625 2.625 0 000-5.25H5.625zM3.75 11.25a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5H3.75zM3 15.75a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75zM3.75 18.75a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5H3.75z" />
                                            </svg></a>

                                        <form method="POST" action="{{ route('admin.users.destroy',$user) }}" class="">
                                            @csrf
                                            @method('DELETE')
                                            <button onClick="return confirm('Are You Sure to Delete')" value=""
                                                type="submit" class="">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor"
                                                    class="w-5 h-5 hover:text-red-900 mt-1 text-red-600">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>not found !</td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</x-app-layout>