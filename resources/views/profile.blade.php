<x-layout>
    <x-slot:headerTitle>{{ $pagetitle }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ (int) request('id') }}</x-navbar>
    </div>

    <div class="mb-20"></div>

    <!-- Main Container -->
    <div class="flex justify-center p-8">
        <div class="max-w-4xl w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Profile Section -->
            <div class="flex items-center p-8 bg-orange-50">
                <!-- Profile Image -->
                <div class="w-1/3 h-1/3 overflow-hidden rounded-full border-4 border-orange-400 shadow-xl">
                    <img class="object-cover w-full h-full"  
                         src="{{ $user->image_profile == 0 
                            ? asset('/images/user_profile.webp') 
                            : asset($user->image_profile) }}" 
                         alt="Profile Picture">
                </div>

                <div class="ml-8 border-l-4 border-orange-200"></div>

                <!-- User Information -->
                <div class="w-2/3 pl-8">
                    <h1 class="text-orange-800 text-3xl font-bold">{{ $user->name }}</h1>
                    <h2 class="text-orange-600 text-xl font-medium mt-2">Username: {{ $user->username }}</h2>
                    <h2 class="text-orange-600 text-xl font-medium mt-2">Address: {{ $user->address }}</h2>
                    <h2 class="text-orange-600 text-xl font-medium mt-2">Phone Number: +{{ $user->phone_number }}</h2>
                    <h2 class="text-orange-600 text-xl font-medium mt-2">Birth Date: {{ $user->birth_date }}</h2>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-between items-center p-8 bg-orange-100">
                <button id="change-profile-image" class="px-6 py-3 bg-yellow-500 text-white text-lg font-medium rounded-lg hover:bg-yellow-600 transition duration-200 ease-in-out">
                    Edit Profile
                </button>
                <div class="flex space-x-4">
                    <a href="#" onclick="document.getElementById('logoutForm').submit();" class="px-6 py-3 bg-red-600 text-white text-lg font-medium rounded-lg hover:bg-red-700 transition duration-200 ease-in-out">
                        Logout
                    </a>
                    <a href="#" onclick="document.getElementById('delete-account-modal').classList.remove('hidden');" class="px-6 py-3 bg-red-500 text-white text-lg font-medium rounded-lg hover:bg-red-600 transition duration-200 ease-in-out">
                        Delete Account
                    </a>
                </div>
            </div>

            <!-- Modal for Editing Profile -->
            <div id="edit-profile-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-yellow-50 p-8 rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-auto">
                    <h2 class="text-2xl font-semibold text-orange-800 mb-6">Edit Profile Information</h2>
                    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Username -->
                        <div class="mt-4">
                            <label for="username" class="block text-lg font-medium text-orange-800">Username</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full p-3 border @error('username') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('username')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Other Fields (Phone, Address, etc.) -->

                        <div class="mt-8 flex justify-between">
                            <button type="submit" class="w-2/4 p-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">Save Changes</button>
                            <button type="button" id="cancel-button" class="w-1/3 p-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>            
            <!-- JavaScript to toggle modal visibility -->
            <script>
                // Show the modal when the button is clicked
                document.getElementById('change-profile-image').addEventListener('click', function() {
                    document.getElementById('edit-profile-modal').classList.remove('hidden');
                });

                // Close the modal when the cancel button is clicked
                document.getElementById('cancel-button').addEventListener('click', function() {
                    document.getElementById('edit-profile-modal').classList.add('hidden');
                });
            </script>

            <!-- Modal for Password Confirmation -->
            <div id="delete-account-modal" class="hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-2xl font-semibold text-orange-950">Confirm Account Deletion</h2>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <!-- Password Input -->
                        <div class="mt-4">
                            <label for="password" class="block text-lg font-medium text-gray-700">Enter Your Password</label>
                            <input type="password" id="password" name="password" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 flex justify-between">
                            <button type="submit" class="rounded-lg p-4 text-xl font-medium text-white bg-blue-500 hover:bg-blue-600">Delete Account</button>
                            <button type="button" onclick="document.getElementById('delete-account-modal').classList.add('hidden');" class="rounded-lg p-4 text-xl font-medium text-white bg-red-500 hover:bg-red-600">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-layout>
