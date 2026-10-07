<div class="flex items-center justify-center py-16 bg-cover bg-center bg-no-repeat px-6"
    style="background-image: url('/images/bg.jpg');">
    <div class="w-full max-w-md bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-8">

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Welcome Back</h2>

        <!-- Form -->
        <form action="{{ route('user.login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-600 text-sm mb-2">Email Address</label>
                <input type="email" placeholder="Enter your email" name="email"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-600 focus:outline-none" />
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-2">Password</label>
                <input type="password" placeholder="Enter your password" name="password"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-600 focus:outline-none" />
            </div>
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" class="rounded text-pink-600 focus:ring-pink-600" />
                    <span class="text-gray-600">Remember me</span>
                </label>
                <button type="button" id="forgotPasswordBtn" class="text-pink-600 hover:underline">
                    Forgot Password?
                </button>
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-pink-600 text-white rounded shadow-md hover:bg-pink-700 transition duration-300">
                Login
            </button>
        </form>

        <!-- Register -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-pink-600 hover:underline">Register</a>
        </p>
    </div>
</div>
