<x-layout>
    <div class="flex justify-center items-center min-h-screen p-6">
        <form action="/register" method="POST" enctype="multipart/form-data" class="p-8 rounded-xl shadow-lg w-full max-w-md space-y-6 border border-gray-200">
            @csrf
            <div class="space-y-5">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-800">Create Your Account</h2>
                    <p class="text-gray-600">Join us today!</p>
                </div>

                <x-form.field>
                    <x-form.label for="name">Full Name</x-form.label>
                    <x-form.input type="text" id="name" name="name" :value="old('name', $googleUser['name'] ?? '')" required class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <x-form.error name="name" />
                </x-form.field>

                <x-form.field>
                    <x-form.label for="email">Email Address</x-form.label>
                    <x-form.input type="email" id="email" name="email" :value="old('email', $googleUser['email'] ?? '' )" required class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <x-form.error name="email" />
                </x-form.field>

                <x-form.field>
                    <x-form.label for="password">Password</x-form.label>
                    <div class="relative">
                        <x-form.input type="password" id="password" name="password" required class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <button type="button" id="toggle-password" aria-label="Show password" class="absolute top-3 right-2">
                            <i class="fas fa-eye text-sm text-gray-400"></i>
                        </button>
                    </div>
                    <x-form.error name="password" />
                </x-form.field>

                <x-form.field>
                    <x-form.label for="password_confirmation">Confirm Password</x-form.label>

                        <x-form.input type="password" id="password_confirmation" name="password_confirmation" required class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <x-form.error name="password_confirmation" />
                </x-form.field>
                <input type="hidden" name="google_id" value="{{ $googleUser['google_id'] ?? '' }}">
            </div>

            <div class="flex flex-col space-y-4">
                <x-form.button class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition-all">Register</x-form.button>
                <div class="flex justify-between items-center text-sm">
                    <p>Already have an account?</p>
                    <a href="/login" class="text-blue-600 font-semibold hover:underline">Login</a>
                </div>
                <a href="/signup/google" class="w-full flex items-center justify-center bg-red-500 text-white p-3 rounded-lg hover:bg-red-600 transition-all">
                    <i class="fab fa-google mr-2"></i>
                    Sign in with Google
                </a>
            </div>
        </form>
    </div>

</x-layout>
