<x-layout>
    <!-- session success message -->
    <x-session />
    <!-- main content -->

    <div class="w-full h-auto flex justify-center items-center p-8">
        <form action="{{ route('admin.borrow-books.store', ['book' => $book->id]) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-xl bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="col-span-2">
                    <h2 class="font-semibold text-lg border-b">Borrow Book</h2>
                </div>
                <!-- selecting the user -->
                <div class="flex flex-col">
                    <label for="user_id" class="font-medium text-gray-700">Select User:</label>
                    <select
                        name="user_id"
                        id="user_id"
                        required
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-2 py-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2">

                        <option value="">-- Choose a User --</option>

                    </select>
                    @error('user_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Selecting a book -->
                <div class="flex flex-col">
                    <label for="book_id" class="font-medium text-gray-700">Book Name: </label>
                    <input
                        type="hidden"
                        name="book_id"
                        id="book_id"
                        value='{{$book->id}}'
                        required>
                    <input
                        type="text"
                        value='{{$book->title}}'
                        disabled
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-2 py-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('book_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- <div class="flex flex-col">
                    <label for="book_id" class="font-medium text-gray-700">Select Book:</label>
                    <select
                        name="book_id"
                        id="book_id"
                        value='{{$book->title}}'
                        required
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-2 py-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2">

                        <option value="">-- Choose a book --</option>

                    </select>
                    @error('book_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div> -->


                <!-- Due Date -->
                <div class="flex flex-col">
                    <label for="due_in_days" class="font-medium text-gray-700">Due Date:</label>
                    <input
                        type="number"
                        name="due_in_days"
                        id="due_in_days"
                        required
                        min="1"
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('due_in_days')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 flex justify-start gap-4">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white py-2 px-6 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-1"></i>Save
                    </button>
                    <a href="{{route('admin.borrow-books.index')}}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
    <!-- Include jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include Select2 JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for user search
            $('#user_id').select2({
                ajax: {
                    url: "{{ route('admin.borrow-books.users.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // Search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(user) {
                                return {
                                    id: user.id,
                                    text: user.name
                                };
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a user',
                minimumInputLength: 0,
                templateResult: function(data) {
                    if (data.loading) {
                        return data.text;
                    }
                    return data.text;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });

        });
    </script>
    @endpush
</x-layout>