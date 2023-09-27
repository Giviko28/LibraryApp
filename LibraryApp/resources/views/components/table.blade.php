<table {{ $attributes->merge(['class' => 'w-full text-sm text-left text-gray-500 dark:text-gray-400']) }} >
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
    <tr>
        <!-- place for table headers/column titles  -->
        {{ $thead }}
    </tr>
    </thead>
    <tbody class="text-center">
        {{ $slot }}
    </tbody>
</table>
