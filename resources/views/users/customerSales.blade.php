<x-app-layout>
    <div class="flex justify-center">
        <div class="mt-4 block rounded-lg shadow-lg bg-white w-full text-start">
            <div class="font-bold py-3 px-6 border-b border-gray-300">
                {{ $user->name." "."Report" }}
            </div>
            <div class="mx-auto drop-shadow rounded-md w-max-auto">
                    <h4 class="uppercase underline text-2xl font-italic font-semibold text-center text-black mb-4">{{ $customer->name." --> "."Sales details." }}</h4>
                
                   
                    <details class="bg-gray-300 open:bg-amber-200 duration-300">
                        <summary class="text-white bg-cool-gray-600 px-5 py-3 text-lg cursor-pointer">Sales</summary>
                        <div class="bg-cool-gray-600 px-5 py-3 border border-gray-300 text-sm font-light">
                          @foreach ($sales as $sale )
                              <ul class="mt-2 mb-2 rounded-lg hover:bg-cool-gray-900 bg-cool-gray-500 text-white text-lg font-bold md:flex md:justify-start p-4 w-min-auto">

                                <a href="
                                {{ route('admin.users/customerSalePayment',['user_id'=>$user->id,'sale_id'=>$sale->id]) }}
                                " class="hover:text-xl">  <li class="mr-6">Weight : {{ $sale->weight." "."kg." }}</li></a>
                                  <li class="mr-6">Rate : {{$sale->rate." "."rs." }}</li>
                                  <li class="mr-6">Total : {{ $sale->total." "."rs." }}</li>
                                  <li class="mr-6 text-green-900 font-strong">Payment Received Status : {{ $sale->status }}</li>
                              </ul>
                          @endforeach
                       <div class="text-white bg-cool-gray-200">
                            {{ $sales->links() }}
                        </div>
                        </div>
      
                    </details>
                
                </div>
        </div>
    </div>

   
</x-app-layout>