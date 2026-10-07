<div class="flex items-center justify-center min-h-screen py-16 bg-cover bg-center bg-no-repeat px-6"
    style="background-image: url('/images/bg.jpg');">
    <div class="w-full max-w-xl bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-8">

        <!-- Title -->
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Create Account</h2>
        <p class="text-center text-gray-500 mb-6 text-sm">Join us and explore more</p>

        <!-- Register Form -->
        <form action="{{ route('store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-600 text-sm mb-2">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-600 focus:border-pink-600 focus:outline-none" />
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email & Phone -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-gray-600 text-sm mb-2">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-600 focus:border-pink-600 focus:outline-none" />
                    @error('email')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="block text-gray-600 text-sm mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your number" value="{{ old('phone') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-600 focus:border-pink-600 focus:outline-none" />
                    @error('phone')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Password & Confirm Password -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-gray-600 text-sm mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-600 focus:border-pink-600 focus:outline-none" />
                    @error('password')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-gray-600 text-sm mb-2">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Re-enter password"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-600 focus:border-pink-600 focus:outline-none" />
                    @error('password_confirmation')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" class="rounded text-pink-600 focus:ring-pink-600" />
                    <span class="text-gray-600">Remember me</span>
                </label>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 px-4 bg-pink-600 text-white rounded-lg shadow-md hover:bg-pink-700 transition duration-300">
                Register
            </button>
        </form>


        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-pink-600 hover:underline font-medium">Login</a>
        </p>
    </div>
</div>
