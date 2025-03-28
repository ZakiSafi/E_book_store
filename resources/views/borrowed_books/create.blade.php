<x-layout>
    <!-- session success message -->
    <x-session />
    <!-- main content -->

    <div class="w-full h-auto flex justify-center items-center p-4 sm:p-8">
        <form action="{{ route('admin.borrow-books.store', ['book' => $book->id]) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-xl bg-white p-4 sm:p-6 rounded-lg shadow-md">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="col-span-2">
                    <h2 class="font-semibold text-lg sm:text-xl border-b pb-2">Borrow Book</h2>
                </div>

                <!-- selecting the user -->
                <div class="flex flex-col">
                    <label for="user_id" class="font-medium text-gray-700 text-sm sm:text-base">Select User:</label>
                    <div class="mt-1 w-full"> <!-- Wrapper div for better control -->
                        <select
                            name="user_id"
                            id="user_id"
                            required
                            class="w-full rounded-md border border-gray-300 bg-white px-2 py-1 sm:px-3 sm:py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2">
                            <option value="">-- Choose a User --</option>
                            @if(isset($user))
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                            @endif
                        </select>
                    </div>
                    @error('user_id')
                    <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selecting a book -->
                <div class="flex flex-col">
                    <label for="book_id" class="font-medium text-gray-700 text-sm sm:text-base">Book Name: </label>
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
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-100 px-2 py-1 sm:px-3 sm:py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('book_id')
                    <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Due Date -->
                <div class="flex flex-col">
                    <label for="due_in_days" class="font-medium text-gray-700 text-sm sm:text-base">Return days:</label>
                    <input
                        type="number"
                        name="due_in_days"
                        id="due_in_days"
                        required
                        min="1"
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('due_in_days')
                    <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 flex flex-col sm:flex-row justify-start gap-3 sm:gap-4">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white py-2 px-4 sm:px-6 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                        <i class="fas fa-save mr-1"></i>Save
                    </button>
                    <a href="javascript:history.go(-2);" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300 text-center text-sm sm:text-base">
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

    <style>
        /* Custom CSS to make Select2 responsive */
        .select2-container {
            width: 100% !important;
        }

        .select2-selection {
            min-height: 38px !important;
            height: auto !important;
        }

        .select2-search__field {
            width: 100% !important;
        }

        @media (max-width: 640px) {
            .select2-container--default .select2-selection--single {
                height: 36px !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 36px !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 36px !important;
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for user search with responsive settings
            var $userSelect = $('#user_id').select2({
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
                width: '100%',
                dropdownAutoWidth: true,
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

            // Handle window resize to ensure Select2 stays responsive
            $(window).on('resize', function() {
                $userSelect.select2('close');
            });

            // Fetch and pre-select the user if user_id is available
            var userId = "{{ request()->query('user_id') }}"; // Get user_id from query parameters
            if (userId) {
                // Fetch user data using an AJAX request
                $.ajax({
                    url: "{{ route('admin.borrow-books.users.search') }}",
                    dataType: 'json',
                    data: {
                        q: userId, // Search by user ID
                    },
                    success: function(data) {
                        if (data.length > 0) {
                            var user = data[0]; // Get the first user from the response

                            // Create a new option and pre-select it
                            var newOption = new Option(user.name, user.id, true, true);
                            $userSelect.append(newOption).trigger('change');
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-layout>
