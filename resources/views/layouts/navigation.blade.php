<aside class="z-20 hidden w-64 overflow-y-auto bg-cool-gray-900 md:block flex-shrink-0">
    <div class="text-gray-500">
        <div class="bg-cool-gray-700 py-3 m-1">
            <a class="hover:bg-cool-gray-500 rounded px-2 ml-6 text-lg font-bold text-white"
                href="{{ route('dashboard') }}">
                ColdStore
            </a>
        </div>


        <ul class="mt-6">
            <li class="hover:bg-cool-gray-800 relative px-6 py-3 text-white">
                <x-nav-link class="" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-slot name="icon" class="">
                        <svg class="text-white w-auto h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </x-slot>
                    <span class="text-white">{{ __('Dashboard') }}</span>
                </x-nav-link>
            </li>
            @can('is_admin')
            <li class="hover:bg-cool-gray-800 relative px-6 py-3">
                <x-nav-link href="{{ route('admin.users.index') }}"
                    :active="request()->routeIs('admin.users.index') || request()->routeIs('admin.users.create') || request()->routeIs('admin.users.edit') ||request()->routeIs('admin.users.show')||request()->routeIs('admin.users/supplierPurcheses')||request()->routeIs('admin.users/supplierPurchesesPayments')||request()->routeIs('admin.users/customerSale')||request()->routeIs('admin.users/customerSalePayment')">
                    <x-slot name="icon">
                        <svg class="text-white w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </x-slot>
                    <span class="text-white">{{ __('Users') }}</span>
                </x-nav-link>
            </li>
            @endcan

            <li class="hover:bg-cool-gray-800 relative px-6 py-3 text-white">
                <x-nav-link class="text-white" href="{{ route('users.suppliers.index') }}"
                    :active="request()->routeIs('users.suppliers.index')||request()->routeIs('users.suppliers.edit')||request()->routeIs('users.suppliers.payments.index')||request()->routeIs('users.suppliers.purcheses.index')||request()->routeIs('users.suppliers.purcheses.edit')||request()->routeIs('users.suppliers.purcheses.payments.index')||request()->routeIs('users.suppliers.purcheses.payments.edit')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="text-white bi bi-bag-dash-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM6 9.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1H6z" />
                        </svg>
                    </x-slot>
                    <span class="text-white">{{ __('Supplier') }}</span>
                </x-nav-link>
            </li>

            <li class="hover:bg-cool-gray-800 relative px-6 py-3 text-white">
                <x-nav-link class="text-white" href="{{ route('users.customers.index') }}"
                    :active="request()->routeIs('users.customers.index')||request()->routeIs('users.customers.edit')||request()->routeIs('users.customers.sale_payments.index')||request()->routeIs('users.customers.sales.index')||request()->routeIs('users.customers.sales.edit')||request()->routeIs('users.customers.sales.sale_payments.index')||request()->routeIs('users.customers.sales.sale_payments.edit')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="text-white bi bi-bag-plus-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                        </svg>
                    </x-slot>
                    <span class="text-white">{{ __('Customer') }}</span>
                </x-nav-link>
            </li>

            <li class="hover:bg-cool-gray-800 relative px-6 py-3 text-white">
                <x-nav-link class="text-white" href="{{ route('users.locals.index') }}"
                    :active="request()->routeIs('users.locals.index')||request()->routeIs('users.locals.edit')">
                    <x-slot name="icon">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                    </x-slot>
                    <span class="text-white">{{ __('Local Sale') }}</span>
                </x-nav-link>
            </li>

            <li class="hover:bg-cool-gray-800 relative px-6 py-3 text-white">
                <x-nav-link class="text-white" href="{{ route('system.purcheseReports.index') }}"
                    :active="request()->routeIs('system.purcheseReports.index')||request()->routeIs('system.purcheseReports.show')||request()->routeIs('system.purcheseReports/payment')">
                    <x-slot name="icon">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                    </svg>
                    </x-slot>
                    <span class="text-white">{{ __('Purchese Report') }}</span>
                </x-nav-link>
            </li>

            <li class="hover:bg-cool-gray-800 relative px-6 py-3 text-white">
                <x-nav-link class="text-white" href="{{ route('system.salesReports.index') }}"
                    :active="request()->routeIs('system.salesReports.index')||request()->routeIs('system.salesReports.show')||request()->routeIs('system.salesReports/payment')">
                    <x-slot name="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                    </x-slot>
                    <span class="text-white">{{ __('Sales Report') }}</span>
                </x-nav-link>
            </li>

            {{-- <li class="relative px-6 py-3 active">
                <button class="text-white inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        @click="toggleMultiLevelMenu" aria-haspopup="true">
                <span class="inline-flex items-center">
                    <svg class="text-white w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="text-white ml-4">Report</span>
                </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isMultiLevelMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-900 dark:hover:text-gray-200">
                            <a class="w-full text-black" href="{{ route('system.purcheseReports.index') }}">Purcheses</a>
                        </li>
                    </ul>

                </template>

                <template x-if="isMultiLevelMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-900  dark:hover:text-gray-200">
                            <a class="w-full text-black" href="{{ route('system.salesReports.index') }}">Sales</a>
                        </li>
                    </ul>
                
                </template>

               
            </li> --}}
        </ul>
    </div>
</aside>