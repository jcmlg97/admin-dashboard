<div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

    @if(isset($header))
        <div class="p-6 border-b dark:border-gray-700 flex items-center justify-between">
            {{ $header }}
        </div>
    @endif

    <div class="overflow-x-auto">
        {{ $slot }}
    </div>

</div>