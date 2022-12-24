<div
    class="">
    @if($profit>0)
    <dd class="bg-teal-600 p-1 rounded">Company is on profit by {{ $profit." "."rs." }}</dd>
    @endif
    @if($loss>0)
     <dd class="bg-red-600 text-white p-1 rounded">Company is on profit by {{ $loss." "."rs." }}
    </dd>
@endif
    </dl>
</div>
</div>