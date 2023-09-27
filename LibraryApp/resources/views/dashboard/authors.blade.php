@props(["authors"])

<x-app-layout>
    <!-- main  -->
    <div x-data="{ open: false }" class="w-full flex justify-center hidden" id="main">
        <!-- Magida -->
        <div x-show="!open" class="max-w-6xl py-4 authors-table">
            <div class="p-4 bg-gray-50  relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="dark:bg-gray-900 flex justify-between items-center space-x-4">
                    <label for="table-search" class="sr-only">Search</label>
                    <button x-on:click="open = !open" class="whitespace-nowrap border-2 rounded-2xl px-2 py-1 font-medium text-blue-600 dark:text-blue-500 hover:text-white hover:bg-blue-600 duration-300">Add an author</button>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <form action="#">
                            <input type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <x-table>
                    <x-slot name="thead">
                        <x-table-header>ID</x-table-header>
                        <x-table-header>Name</x-table-header>
                        <x-table-header>Action</x-table-header>
                    </x-slot>
                    @if($authors)
                        @foreach($authors as $author)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <x-table-data scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $author->id }}</x-table-data>
                                <x-table-data>{{ $author->name }}</x-table-data>
                                <x-table-data><a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a></x-table-data>
                            </tr>
                        @endforeach
                    @endif
                </x-table>
            </div>
        </div>
        <!-- Forma -->
        <div x-show="open" class="my-4 p-4 bg-white rounded author-create">
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
            <form action="{{ route('authors.create') }}" method="POST" class="space-y-2 flex flex-col justify-center">
                @csrf
                <x-text-input name="name" class="block" placeholder="Enter the authors name" />
                <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
