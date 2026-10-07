<div id="forgotPasswordModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/70">
    <div class="bg-white w-full max-w-md p-8 relative rounded-lg shadow-lg">

        <button id="closeForgotPassword"
            class="absolute top-4 right-4 text-pink-600 hover:text-pink-700 text-2xl transition">
            <i class="fas fa-times"></i>
        </button>

        <h2 class="text-2xl font-semibold text-pink-600 mb-3 text-center">Forgot Password</h2>
        <p class="text-gray-500 text-sm text-center mb-6">
            Enter your registered email and we’ll send you a link to reset your password.
        </p>

        <form id="forgotPasswordForm" class="space-y-5">
            <div>
                <label for="resetEmail" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="resetEmail" name="resetEmail" placeholder="you@example.com"
                    class="w-full border border-gray-300 rounded px-4 py-2 
                 focus:outline-none focus:ring-2 focus:ring-pink-600 
                 focus:border-transparent placeholder-gray-400 transition"
                    required />
            </div>

            <button type="submit"
                class="w-full bg-pink-600 hover:bg-pink-700 text-white  py-2 rounded transition-all duration-300">
                Send Reset Link <i class="fa-solid fa-paper-plane ml-2"></i>
            </button>
        </form>

        <p class="text-gray-400 text-xs text-center mt-4">
            We’ll never share your email with anyone else.
        </p>
    </div>
</div>

<div id="forgotToast"
    class="fixed top-6 right-6 bg-green-500 text-white px-6 py-3 rounded opacity-0 pointer-events-none transition-all duration-300 z-50">
    Reset link sent successfully!
</div>

<script>
    const forgotModal = document.getElementById('forgotPasswordModal');
    const closeForgot = document.getElementById('closeForgotPassword');
    const forgotForm = document.getElementById('forgotPasswordForm');
    const forgotToast = document.getElementById('forgotToast');

    closeForgot.addEventListener('click', () => {
        forgotModal.classList.add('hidden');
    });

    forgotForm.addEventListener('submit', function(e) {
        e.preventDefault();

        forgotModal.classList.add('hidden');

        forgotToast.classList.remove('opacity-0', 'pointer-events-none');
        forgotToast.classList.add('opacity-100', 'pointer-events-auto');

        setTimeout(() => {
            forgotToast.classList.remove('opacity-100', 'pointer-events-auto');
            forgotToast.classList.add('opacity-0', 'pointer-events-none');
        }, 3000);

        forgotForm.reset();
    });
</script>
