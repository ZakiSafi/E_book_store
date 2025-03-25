<x-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-50 mt-12">
        <form action="/register" method="POST" enctype="multipart/form-data" class="p-6 bg-white rounded-lg shadow-sm w-full max-w-md border border-gray-100">
            @csrf
            <div class="space-y-4">
                <!-- Header -->
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-800">Create Your Account</h2>
                    <p class="text-sm text-gray-500 mt-1">Join us and get started</p>
                </div>

                <!-- Full Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $googleUser['name'] ?? '') }}" required
                        class="mt-1 w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm placeholder-gray-400">
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $googleUser['email'] ?? '') }}" required
                        class="mt-1 w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm placeholder-gray-400">
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative mt-1">
                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm placeholder-gray-400 pr-10">
                        <button type="button" aria-label="Show password" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="relative mt-1">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm placeholder-gray-400 pr-10">
                        <button type="button" aria-label="Show password" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="google_id" value="{{ $googleUser['google_id'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full mt-6 bg-blue-600 text-white py-2 rounded-md text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Register
            </button>

            <!-- Divider -->
            <div class="flex items-center my-4">
                <div class="flex-1 border-t border-gray-200"></div>
                <span class="mx-3 text-sm text-gray-400">OR</span>
                <div class="flex-1 border-t border-gray-200"></div>
            </div>

            <!-- Google Sign-In Button -->
            <a href="/signup/google" class="w-full flex items-center justify-center bg-white text-gray-700 py-2 rounded-md text-sm font-semibold border border-gray-200 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <i class="fab fa-google mr-2 text-red-500"></i> Sign in with Google
            </a>

            <!-- Login Link -->
            <p class="text-center text-sm text-gray-500 mt-4">
                Already have an account? <a href="/login" class="text-blue-600 hover:text-blue-700 font-semibold">Log In</a>
            </p>
        </form>
    </div>
</x-layout>
