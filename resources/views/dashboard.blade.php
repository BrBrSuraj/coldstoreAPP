<x-app-layout>
  <div class="bg-gray-200 rounded-lg shadow-xs mt-4">
    <div class="bg-gray-400 rounded">
      <h5 class=" text-xl px-2 py-2 rounded mb-2 font-semibold mx-5">Dashboard</h5>
    </div>
    <div class="rounded-lg flex flex-col text-center bg-teal-500 mx-1 text-white font-semibold md:flex-row md:p-2 md:justify-center md:text-2xl">
      @include('trnsdtl.profit')
      <div>
        <h5 class="px-2 text-cool-gray-700 text-center text-3xl py-1 rounded underline  font-bold mx-5">Overall Details
        </h5>
      </div>
      
      <div class="overallInfo flex flex-col md:flex-row md:justify-start mb-4">
      
        <div class="md:flex p-5 flex md:flex-row flex-col md:ml-36 bg-gray-700 rounded  md:my-1 mb-2">
          @include('trnsdtl.purchesedtl')
          @include('trnsdtl.saledtl')
          @include('trnsdtl.localsale')
      
        </div>
      
      </div>
    </div>
   
     
    </div>

  

  </div>
  {{-- java script for purcheses chart --}}

</x-app-layout>