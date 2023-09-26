@props(["books"])

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div x-data="{ open: false }" class="w-full flex justify-center">
        <!-- Magida -->
        <div class="max-w-6xl py-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="bg-white dark:bg-gray-900 flex justify-between items-center">
                    <label for="table-search" class="sr-only">Search</label>
                    <button class="">Toggle</button>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <form action="/dashboard">
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
                                    {{ $book->status }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Forma -->
        <div x-show="open">
            <form action="">
                <input type="text" placeholder="title">
                <input type="number" placeholder="release date">
                <input type="text" placeholder="author">
            </form>
        </div>

    </div>
</x-app-layout>
