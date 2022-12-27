<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs md:w-full w-50">
        @include('status.status')


        <div class="block rounded-lg border shadow-lg bg-gray-200 w-60 md:w-full">
            <div class="flex justify-between w-full bg-gray-300">
               <div class="py-3 px-2  border-gray-900 bg-gray-400 w-full flex flex-row gap-2 justify-start items-center">
                    <h4 class="font-bold text-lg ">Payment Details of</h4>
                    <span class="font-bold text-lg text-gray-900"> {{$supplier->name }}</span>
                </div>

            </div>

           <div class="flex justify-between w-full items-center">
            
                <div class="py-3 px-6 items-center  border-gray-300 bg-cool-gray-400 w-full flex flex-col md:flex-row gap-10">
                    <h1 class="text-white px-2 shadow-md">INFO :</h1>
                    <h4 class="font-bold uppercase bg-red-500 px-2 shadow-lg rounded text-white">Due Amount :
                    {{ $supplier->supplierDue()}}
                    </h4>
                    <h4 class="font-bold uppercase bg-green-300 px-2 shadow-lg rounded">Paid :
                      {{ $supplier->payments->sum('amount')." "."rs." }}
                    </h4>
                </div>
            </div>

            
           
            @include('payment.paymentform')
            
           

           

            <div class="md:grid md:grid-cols-3 mb:mb-4">
                <div class="overflow-x-auto w-max-auto mt-2 px-2 col-span-2">
                    @include('payment.paymentTable')
                   
                  
                </div>

                @include('payment.transactionInfo')

                
            </div>


        </div>


    </div>
</x-app-layout>