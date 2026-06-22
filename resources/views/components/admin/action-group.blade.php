@props([
    'show' => null,
    'edit' => null,
    'delete' => null,
])

<div class="flex items-center gap-2">

    @if($show)
        <a href="{{ $show }}"
           class="px-3 py-1 text-sm rounded-lg
                  bg-blue-100 text-blue-700
                  hover:bg-blue-200 transition
                  dark:bg-blue-900 dark:text-blue-300">
            Ver
        </a>
    @endif

    @if($edit)
        <a href="{{ $edit }}"
           class="px-3 py-1 text-sm rounded-lg
                  bg-yellow-100 text-yellow-700
                  hover:bg-yellow-200 transition
                  dark:bg-yellow-900 dark:text-yellow-300">
            Editar
        </a>
    @endif

    @if($delete)
        <x-confirm-delete :action="$delete" />
    @endif

</div>