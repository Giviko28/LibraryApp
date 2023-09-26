@props(["books", "authors"])

<x-app-layout>
    <!-- main  -->
    <div x-data="{ open: false }" class="w-full flex justify-center">
        <!-- Magida -->
        <div x-show="!open" class="max-w-6xl py-4">
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
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Authors
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Release Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Availability
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($books)
                        @foreach($books as $book)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $book->title }}
                                </th>
                                <td class="px-6 py-4">
                                    @foreach($book->authors as $author)
                                        <a href="/dashboard/authors/{{ $author->id }}">{{ $author->name }}</a>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $book->release_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $book->status ? "Yes" : "No" }}
                                </td>
                                <td class="px-6 py-4 space-x-1.5 flex">
                                    <a href="{{ route('books.edit', ['book' => $book]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('books.destroy', ['book' => $book]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Forma -->
        <div x-show="open" class="my-4 p-4 bg-white rounded">
            <div class="pb-2">
                <img x-on:click="open = !open" src="{{ asset("png/arrow.png") }}" alt="Arrow icon" class="cursor-pointer">
            </div>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="/dashboard/books/create" method="POST" class="space-y-2">
                @csrf
                <x-text-input name="title" class="block" placeholder="Enter the book title" />
                <x-text-input type="number" name="release_date" class="block" placeholder="Release date" />
                <div id="authors">
                    <div class="flex">
                        <select name="authors[]" id="authorList" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" id="add_author" class="">+</button>
                    </div>
                </div>
                <label class="relative inline-flex items-center mb-4 cursor-pointer">
                    <input name="status" type="checkbox" value="1" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Available</span>
                </label>
                <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
