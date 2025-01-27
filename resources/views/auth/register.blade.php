<x-layout>

        <div class="flex justify-center items-center min-h-screen bg-gray-100">
            <form action="/register" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                @csrf

                @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="space-y-4">
                    <x-form.field>
                        <x-form.label for="name">Name</x-form.label>
                        <x-form.input type="text" id="name" name="name" :value="old('name')" required class="w-full" />
                        <x-form.error name="name" />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="email">Email</x-form.label>
                        <x-form.input type="email" id="email" name="email" :value="old('email')" required class="w-full" />
                        <x-form.error name="email" />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="password">Password</x-form.label>
                        <x-form.input type="password" id="password" name="password" required class="w-full" />
                        <x-form.error name="password" />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="password_confirmation">Password Confirmation</x-form.label>
                        <x-form.input type="password" id="password_confirmation" name="password_confirmation" required class="w-full" />
                        <x-form.error name="password_confirmation" />
                    </x-form.field>
                    <div class="flex items-center justify-between">
                        <x-form.button>Register</x-form.button>
                        <div class="flex justify-between items-center gap-2 pr-2">
                            <p>Already have an account?</p>
                            <a href="/login" class="hover:underline hover:text-md font-semibold hover:bg-gray-200 text-black rounded-md px-1">login</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
</x-layout>
