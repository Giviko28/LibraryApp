@props(['book', 'authors'])

<x-app-layout>
    <div id="main" class="flex justify-center hidden">
        <div class="max-w-2xl my-4 p-4 bg-white rounded">
            <div class="pb-2 flex justify-between">
                <a href="{{ route('dashboard') }}"><img src="{{ asset("png/arrow.png") }}" alt="Arrow icon" class="cursor-pointer"></a>
                <button type="button" id="add_author" class="">Add author</button>
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
                <x-text-input id="title" name="title" class="block w-full" placeholder="Enter the book title" value="{{ $book->title }}" />
                <x-text-input id="release_date" type="number" name="release_date" class="block w-full" placeholder="Release date" value="{{ $book->release_date }}" />
                <div id="authors">
                    @foreach($book->authors as $index => $author)
                        <div class="flex">
                            <select name="authors[]" id="oldAuthors" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option selected value="{{ $author->id }}">{{ $author->name }}</option>
                                @foreach($authors as $allAuthors)
                                    <option value="{{ $allAuthors->id }}">{{ $allAuthors->name }}</option>
                                @endforeach
                            </select>
                            <button class="pl-4 text-red-600" type="button" id="select{{ $index+1 }}">Delete</button>
                        </div>
                    @endforeach
                    <div id="authorList" class="flex">
                        <select name="authors[]" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option selected disabled>Select an author</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <x-toggle-switch isChecked="{{ $book->status }}">Is the book still available?</x-toggle-switch>
                <div class="w-full flex justify-center">
                    <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
