@props(['book', 'authors'])

<x-app-layout>
    <div class="flex justify-center">
        <div class="max-w-2xl my-4 p-4 bg-white rounded">
            <div class="pb-2">
                <a href="{{ route('dashboard') }}"><img src="{{ asset("png/arrow.png") }}" alt="Arrow icon" class="cursor-pointer"></a>
            </div>
            <div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form  id="book-update" action="{{ route('books.update', ['book' => $book]) }}" method="POST" class="space-y-2">
                @csrf
                @method('PATCH')
                <x-text-input id="title" name="title" class="block" placeholder="Enter the book title" value="{{ $book->title }}" />
                <x-text-input id="release_date" type="number" name="release_date" class="block" placeholder="Release date" value="{{ $book->release_date }}" />
                <div id="authors">
                    @foreach($book->authors as $index => $author)
                        <div>
                            <select name="authors[]" id="oldAuthors" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option selected value="{{ $author->id }}">{{ $author->name }}</option>
                                @foreach($authors as $allAuthors)
                                    <option value="{{ $allAuthors->id }}">{{ $allAuthors->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" id="select{{ $index+1 }}">Delete</button>
                        </div>
                    @endforeach
                    <div id="authorList" class="flex">
                        <select name="authors[]" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option selected disabled>Select an author</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" id="add_author" class="">+</button>
                    </div>
                </div>
                <label class="relative inline-flex items-center mb-4 cursor-pointer">
                    <input name="status" type="checkbox" value="1" class="sr-only peer" {{ $book->status ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Available</span>
                </label>
                <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
