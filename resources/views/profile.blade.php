<x-layout>
    <x-slot:headerTitle>{{ $pagetitle }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ (int) request('id') }}</x-navbar>
    </div>

    <div class="mb-20"></div>

    <div class="flex p-8">
        <!-- Profile Image -->
        <div class="w-1/3 h-1/3 overflow-hidden rounded-full border-2 border-orange-300">
            <img class="object-cover w-full h-full"  
                src="{{ $user->image_profile == 0 
                    ? asset('/images/user_profile.webp') 
                    : asset($user->image_profile) }}" 
                alt="Profile Picture">
        </div>
        

        <div class="ml-12 border-l-2 border-orange-200"></div>
        <div class="mr-12"></div>  

        <!-- User Information -->
        <div class="w-2/3">
            <h1 class="text-orange-200 text-7xl font-bold">{{ $user->name }}</h1>
            <div class="mb-8"></div>

            <h1 class="text-orange-200 text-3xl font-medium">Username: {{ $user->username }}</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Address: {{ $user->address }}</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Phone Number: +{{ $user->phone_number }}</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Birth Date: {{ $user->birth_date }}</h1>

            <div class="mb-20"></div>

            <!-- Edit Profile Button -->
            <button id="change-profile-image" class="rounded-lg p-4 text-3xl font-medium text-white bg-yellow-500 hover:bg-yellow-600 hover:text-white cursor-pointer">
                Edit Profile
            </button>
            <!-- Edit Profile Image and Information Modal (Hidden by default) -->
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
            
                        <!-- Full Name -->
                        <div class="mt-4">
                            <label for="name" class="block text-lg font-medium text-orange-800">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-3 border @error('name') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('name')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Phone Number -->
                        <div class="mt-4">
                            <label for="phone_number" class="block text-lg font-medium text-orange-800">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full p-3 border @error('phone_number') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('phone_number')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Address -->
                        <div class="mt-4">
                            <label for="address" class="block text-lg font-medium text-orange-800">Address</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="w-full p-3 border @error('address') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('address')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Birth Date -->
                        <div class="mt-4">
                            <label for="birth_date" class="block text-lg font-medium text-orange-800">Birth Date</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" class="w-full p-3 border @error('birth_date') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('birth_date')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Password -->
                        <div class="mt-4">
                            <label for="current_password" class="block text-lg font-medium text-orange-800">Current Password (Optimal)</label>
                            <input type="password" name="current_password" class="w-full p-3 border @error('current_password') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('current_password')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mt-4">
                            <label for="new_password" class="block text-lg font-medium text-orange-800">New Password (Optimal)</label>
                            <input type="password" name="new_password" class="w-full p-3 border @error('new_password') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('new_password')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mt-4">
                            <label for="new_password_confirmation" class="block text-lg font-medium text-orange-800">Confirm New Password (Optimal)</label>
                            <input type="password" name="new_password_confirmation" class="w-full p-3 border @error('new_password_confirmation') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
            
                        <!-- Profile Image -->
                        <div class="flex items-center">
                            <label for="image_profile" class="block text-lg font-medium text-orange-800 mr-4">Change Profile Image</label>
                                <input type="file" id="image_profile" name="image_profile" class="mt-2 w-full p-2 border border-orange-200 rounded-md" accept="image/*">
                        </div>
            
                        <!-- Submit Button -->
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


            <!-- Logout Button -->
            <a href="#" onclick="document.getElementById('logoutForm').submit();" 
               class="ml-4 rounded-lg p-4 text-3xl font-medium text-white cursor-pointer bg-red-600 hover:bg-red-800" 
               aria-current="page">
                Logout
            </a>
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" id="logoutForm" style="display: none;">
                @csrf
            </form>

            <!-- Delete Account Button -->
            <a href="#" onclick="document.getElementById('delete-account-modal').classList.remove('hidden');" 
               class="ml-4 rounded-lg p-4 text-3xl font-medium text-white cursor-pointer bg-red-500 hover:bg-red-600" 
               aria-current="page">
                Delete Account
            </a>   
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
