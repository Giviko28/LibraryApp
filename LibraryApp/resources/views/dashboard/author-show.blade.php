@props(['author', 'books'])

<x-app-layout>
    <div class="flex justify-center">
        <div class="max-w-6xl  py-4">
            <h1>{{ $author->name }}'s books</h1>
            <x-table class="mt-4">
                <x-slot name="thead">
                    <x-table-header>Title</x-table-header>
                    <x-table-header>Release Date</x-table-header>
                </x-slot>
                @foreach($books as $book)
                    <tr>
                        <x-table-data>{{ $book->title }}</x-table-data>
                        <x-table-data>{{ $book->release_date }}</x-table-data>
                    </tr>
                @endforeach
            </x-table>
        </div>
    </div>
</x-app-layout>
