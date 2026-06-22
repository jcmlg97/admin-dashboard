@props(['role'])

<span class="px-3 py-1 text-xs rounded-full
    {{ $role === 'admin'
        ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300'
        : 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300' }}">
    {{ ucfirst($role) }}
</span>