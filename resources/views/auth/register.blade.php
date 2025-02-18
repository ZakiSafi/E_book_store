<x-layout>
    <div class="flex justify-center items-center min-h-screen p-6 bg-white">
        <form action="/register" method="POST" enctype="multipart/form-data" class="p-8 rounded-xl shadow-lg w-full max-w-md space-y-6 border border-gray-200">
            @csrf
            <div class="space-y-5">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-800">Create Your Account</h2>
                    <p class="text-gray-600">Join us today!</p>
                </div>

                <x-form.input label="Full Name" name="name" :value="old('name', $googleUser['name'] ?? '')" required />

                <x-form.input label="Email Address" name="email" type="email" :value="old('email', $googleUser['email'] ?? '' )" required />

                <x-form.input label="Password" name="password" type="password" required />

                <x-form.input label="Confirm Password" name="password_confirmation" type="password" required />

                <input type="hidden" name="google_id" value="{{ $googleUser['google_id'] ?? '' }}">
            </div>

            <div class="flex flex-col space-y-4">
                <button type='submit' class="w-full flex items-center justify-center bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition-all">Register</button>

                <div class="relative flex items-center justify-center">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="mx-4 text-sm text-gray-500">OR</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <a href="/signup/google" class="w-full flex items-center justify-center bg-red-500 text-white p-3 rounded-lg hover:bg-red-600 transition-all">
                    <i class="fab fa-google mr-2"></i>
                    Sign in with Google
                </a>
            </div>
            <p class="text-center text-sm text-gray-600">
                Already have an account? <a href="/login" class="text-blue-500 hover:text-blue-700">Log In</a>
            </p>
        </form>
    </div>
</x-layout>