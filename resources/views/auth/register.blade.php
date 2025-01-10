<x-layout>

    <x-slot:headerTitle>{{ 'Register' }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="h-screen flex justify-center items-center">
        <form method="POST" action="/register" class="bg-yellow-50 p-8 rounded-lg shadow-lg w-full max-w-sm"> 
            @csrf
            <h2 class="text-3xl font-semibold text-center text-orange-800 mb-6">Register</h2>
            
            <input type="text" name="username" placeholder="Username" required class="w-full p-3 border @error('username') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('username')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-5"></div>

            <input type="text" name="name" placeholder="Full Name" required class="w-full p-3 border @error('name') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('name')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-5"></div>

            <input type="text" name="phone_number" placeholder="Phone Number" required class="w-full p-3 border @error('phone_number') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('phone_number')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-5"></div>

            <input type="text" name="address" placeholder="Address" required class="w-full p-3 border @error('address') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('address')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-5"></div>

            <input type="date" name="birth_date" placeholder="Birth Date" required class="w-full p-3 border @error('birth_date') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('birth_date')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-5"></div>

            <input type="password" name="password" placeholder="Password" required class="w-full p-3 border @error('password') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('password')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-5"></div>

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full p-3 border @error('password_confirmation') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('password_confirmation')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-5"></div>

            <!-- Is Admin Checkbox -->
            <div class="flex items-center mb-5">
                <input type="checkbox" name="isAdmin" value="1" class="mr-2" id="isAdmin">
                <label for="isAdmin" class="text-sm text-orange-800">This account is Admin</label>
            </div>
        
            <button type="submit" class="w-full p-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">Register</button>
        
            <div class="mt-4 text-center">
                <a href="/login" class="text-orange-800 text-sm hover:text-orange-500" aria-current="page">Already have an account? Login here!</a>
            </div>
        </form>        
    </div>

</x-layout>
