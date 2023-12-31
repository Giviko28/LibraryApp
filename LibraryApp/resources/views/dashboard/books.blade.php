@props(["books", "authors"])

<x-app-layout>
    <!-- main  -->
    <div x-data="{ open: false }" class="w-full flex justify-center hidden" id="main">
        <!-- Magida -->
        <div x-show="!open" class="max-w-6xl py-4 books-table">
            <div class="p-4 bg-gray-50  relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="dark:bg-gray-900 flex justify-between items-center">
                    <label for="table-search" class="sr-only">Search</label>
                    <button x-on:click="open = !open" class="border-2 rounded-2xl px-2 py-1 font-medium text-blue-600 dark:text-blue-500 hover:text-white hover:bg-blue-600 duration-300">Add a book</button>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <form action="{{ route('dashboard') }}">
                            <input name="search" type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <x-table>
                    <x-slot name="thead">
                        <x-table-header>Title</x-table-header>
                        <x-table-header>Authors</x-table-header>
                        <x-table-header>Release Date</x-table-header>
                        <x-table-header>Availability</x-table-header>
                        <x-table-header>Action</x-table-header>
                    </x-slot>
                    <!-- Table body --->
                    @if($books)
                        @foreach($books as $book)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <x-table-data scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->title }}</x-table-data>
                                <x-table-data>
                                    @foreach($book->authors as $author)
                                        <a href="/dashboard/authors/{{ $author->id }}">{{ $author->name }}</a>
                                    @endforeach
                                </x-table-data>
                                <x-table-data>{{ $book->release_date }}</x-table-data>
                                <x-table-data class="{{ $book->status ? 'text-green-500' : 'text-red-600' }}">{{ $book->status ? "Yes" : "No" }}</x-table-data>
                                <x-table-data class="flex space-x-2">
                                    <a href="{{ route('books.edit', ['book' => $book]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('books.destroy', ['book' => $book]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                    </form>
                                </x-table-data>
                            </tr>
                        @endforeach
                    @endif
                    <!-- end of table body -->
                </x-table>
            </div>
        </div>
        <!-- Forma -->
        <div x-show="open" class="my-4 p-4 bg-white rounded book-update">
            <div class="pb-2 flex justify-between">
                <img x-on:click="open = !open" src="{{ asset("png/arrow.png") }}" alt="Arrow icon" class="cursor-pointer">
                <button type="button" id="add_author">Add author</button>
            </div>

            <x-error-message/>

            <form action="/dashboard/books/create" method="POST" class="space-y-2">
                @csrf
                <x-text-input name="title" class="block w-full" placeholder="Enter the book title" />
                <x-text-input type="number" name="release_date" class="block w-full" placeholder="Release date" />
                <div id="authors">
                    <div id="authorList" class="flex">
                        <select name="authors[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <x-toggle-switch isChecked="{{ false }}">Is the book available?</x-toggle-switch>
                <div class="w-full flex justify-center">
                    <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
