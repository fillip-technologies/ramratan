<section x-data="{ editField: null }" class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Account Settings</h2>

        <div class="bg-white rounded-xl shadow border border-rose-100 p-6 space-y-6">


            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Full Name</p>
                    <p x-show="editField !== 'name'" class="text-gray-800 font-medium">Mohit Kumar</p>
                    <input x-show="editField === 'name'" type="text" value="Mohit Kumar"
                        class="mt-1 w-full border px-3 py-2 rounded-md shadow-sm 
         focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent text-gray-800" />

                </div>
                <div>
                    <button x-show="editField !== 'name'" @click="editField = 'name'"
                        class="text-sm text-pink-600 hover:underline">
                        Edit
                    </button>
                    <div x-show="editField === 'name'" class="flex gap-2">
                        <button @click="editField = null"
                            class="px-3 py-1 bg-pink-600 text-white text-sm rounded hover:bg-pink-700">Save</button>
                        <button @click="editField = null"
                            class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</button>
                    </div>
                </div>
            </div>

            <hr>


            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p x-show="editField !== 'email'" class="text-gray-800 font-medium">mohit@example.com</p>
                    <input x-show="editField === 'email'" type="email" value="mohit@example.com"
                        class="mt-1 w-full border px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent text-gray-800" />
                </div>
                <div>
                    <button x-show="editField !== 'email'" @click="editField = 'email'"
                        class="text-sm text-pink-600 hover:underline">
                        Edit
                    </button>
                    <div x-show="editField === 'email'" class="flex gap-2">
                        <button @click="editField = null"
                            class="px-3 py-1 bg-pink-600 text-white text-sm rounded hover:bg-pink-700">Save</button>
                        <button @click="editField = null"
                            class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</button>
                    </div>
                </div>
            </div>

            <hr>


            <div x-data="{ editField: null, showPassword: false }" class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Password</p>


                    <p x-show="editField !== 'password'" class="text-gray-800 font-medium">••••••••</p>


                    <div x-show="editField === 'password'" class="relative">
                        <input :type="showPassword ? 'text' : 'password'" value="12345678"
                            class="mt-1 w-full border px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent text-gray-800 pr-10" />


                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                            <i x-show="!showPassword" class="fa fa-eye"></i>
                            <i x-show="showPassword" class="fa fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <button x-show="editField !== 'password'" @click="editField = 'password'"
                        class="text-sm text-pink-600 hover:underline">
                        Edit
                    </button>
                    <div x-show="editField === 'password'" class="flex gap-2">
                        <button @click="editField = null"
                            class="px-3 py-1 bg-pink-600 text-white text-sm rounded hover:bg-pink-700">Save</button>
                        <button @click="editField = null"
                            class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</button>
                    </div>
                </div>
            </div>


        </div>

        <div class="flex items-center justify-start mt-5 px-2">

            <button type="button" id="forgotPasswordBtn" class="text-pink-600 hover:underline">
                Forgot Password?
            </button>
        </div>
    </div>
</section>
