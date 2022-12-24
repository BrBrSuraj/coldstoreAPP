<x-app-layout>
    <div class="flex justify-center">
        <div class="mt-4 block rounded-lg shadow-lg bg-white w-full text-start">
            <div class="font-bold py-3 px-6 border-b border-gray-300">
                {{ $user?$user->name." "."Report":"" }}
            </div>
            <div class="mx-auto drop-shadow rounded-md w-max-auto">
                    {{-- <h4 class="uppercase underline text-2xl font-italic font-semibold text-center text-black mb-4">{{ $supplier->name." --> "."Purchese details." }}</h4> --}}
                
                    <!-- Supplier -->
                    <details class="bg-gray-300 open:bg-amber-200 duration-300">
                        <summary class="text-white bg-cool-gray-600 px-5 py-3 text-lg cursor-pointer">Payments</summary>
                        <div class="bg-cool-gray-600 px-5 py-3 border border-gray-300 text-sm font-light">
                          @forelse ($payments as $payment )
                              <ul class="mt-2 mb-2 rounded-lg hover:bg-cool-gray-900 bg-cool-gray-500 text-white text-lg font-bold md:flex md:justify-start p-4 w-min-auto">
                                  <li class="mr-6">Amount : {{$payment->amount." "."rs." }}</li>
                                  <li class="mr-6">Date : {{$payment->created_at }}</li>
                              </ul>
                              @empty

                              <ul
                                class="mt-2 mb-2 rounded-lg hover:bg-cool-gray-900 bg-cool-gray-500 text-white text-lg font-bold md:flex md:justify-start p-4 w-min-auto">
                               
                                <li class="mr-6">Payment Not Found !</li>
                            </ul>

                          @endforelse
                       <div class="text-white bg-cool-gray-200">
                            {{ $payments->links() }}
                        </div>
                        </div>
                      
                    </details>

                </div>
        </div>
    </div>

   
</x-app-layout>