<x-app-layout>
<div class="flex justify-start mt-5">
    <div class="border block rounded-lg shadow-lg bg-white text-start w-9/12">
        <div class="flex font-bold py-3 px-6 border-b border-gray-300 justify-between">
            New Payment
            <div class="text-red-700 font-bold">
                @if($due==0)
                {{"Payment already cleared. Due:"." "."0"}}
                @else
                Due:{{" ". $due }}
                @endif
            </div>
        </div>
 
      
    </div>
</div>
 
</x-app-layout>
