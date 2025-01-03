<x-layout>

    <x-slot:headerTitle>{{ 'Login' }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="h-screen flex justify-center items-center">
        <form method="POST" action="/login" class="bg-yellow-50 p-8 rounded-lg shadow-lg w-full max-w-sm"> 
            @csrf
            <h2 class="text-3xl font-semibold text-center text-orange-800 mb-6">Login</h2>
            
            <input type="text" name="username" placeholder="Username" required class="w-full p-3 border @error('username') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('username')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-5"></div>

            <input type="password" name="password" placeholder="Password" required class="w-full p-3 border @error('password') border-red-500 @else border-orange-200 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            @error('password')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mb-2"></div>
            
            <a href="/register" class="text-orange-800 text-sm hover:text-orange-500" aria-current="page">No account? Register here!</a>
            <div class="mb-5"></div>

            <button type="submit" class="w-full p-2 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">Login</button>
        </form>        
    </div>

</x-layout>
