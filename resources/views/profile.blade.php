<x-layout>
    <x-slot:headerTitle>{{ $pagetitle }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ (int) request('id') }}</x-navbar>
    </div>

    <div class="mb-20"></div>

    <div class="flex p-8">
        <!-- Profile Image -->
        <div class="w-1/3">
            <img class="size-full rounded-full border-2 border-orange-300" 
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

            <!-- Edit Profile Image Button -->
            <button id="change-profile-image" class="rounded-lg p-4 text-3xl font-medium text-white bg-yellow-500 hover:bg-yellow-600 hover:text-white cursor-pointer">
                Change Profile Image
            </button>

            <!-- Edit Profile Image Form Modal (Hidden by default) -->
            <div id="edit-image-modal" class="hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-2xl font-semibold text-orange-950">Change Profile Image</h2>
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Image -->
                        <div class="mt-4">
                            <label for="image_profile" class="block text-lg font-medium text-gray-700">Choose New Profile Image</label>
                            <input type="file" id="image_profile" name="image_profile" class="mt-2 w-full p-2 border border-gray-300 rounded-md" accept="image/*" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 flex justify-between">
                            <button type="submit" class="rounded-lg p-4 text-xl font-medium text-white bg-blue-500 hover:bg-blue-600">Save Changes</button>
                            <button type="button" id="cancel-button" class="rounded-lg p-4 text-xl font-medium text-white bg-red-500 hover:bg-red-600">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Logout Button -->
            <a href="#" onclick="document.getElementById('logoutForm').submit();" 
               class="rounded-lg p-4 text-3xl font-medium text-white bg-red-600 hover:bg-red-800 hover:text-white" 
               aria-current="page">
                Logout
            </a>
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" id="logoutForm" style="display: none;">
                @csrf
            </form>
            
        </div>
    </div>

    <!-- JavaScript to toggle modal visibility -->
    <script>
        // Show the modal when the button is clicked
        document.getElementById('change-profile-image').addEventListener('click', function() {
            document.getElementById('edit-image-modal').classList.remove('hidden');
        });

        // Close the modal when the cancel button is clicked
        document.getElementById('cancel-button').addEventListener('click', function() {
            document.getElementById('edit-image-modal').classList.add('hidden');
        });
    </script>
</x-layout>
