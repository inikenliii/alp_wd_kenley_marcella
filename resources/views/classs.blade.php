<x-layout>
    <x-slot:headerTitle>{{ $pagetitle }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ $id }}</x-navbar>
    </div>

    <div class="mb-20"></div>

    <div class="p-4">
        <h1 class="text-7xl font-bold text-orange-300 text-center">Class</h1>
        <div class="mb-16"></div>

        <div class="h-screen flex justify-center items-center">
            <div class="bg-yellow-50 p-8 rounded-lg shadow-lg w-full max-w-lg">
                <!-- Class Details -->
                <h2 class="text-3xl font-semibold text-center text-orange-800 mb-6">{{ $class->class_name }}</h2>
    
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-orange-700">Description:</h3>
                    <p class="text-gray-600">{{ $class->description }}</p>
                </div>
    
                {{-- <!-- Show related users -->
                @if($class->users->isNotEmpty())
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-orange-700">Users Enrolled:</h3>
                        <ul class="list-disc ml-5">
                            @foreach($class->users as $user)
                                <li class="text-gray-600">{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p class="text-gray-600">No users enrolled yet.</p>
                @endif --}}
    
                <!-- Show related training sessions -->
                @if($class->trainsessions->isNotEmpty())
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-orange-700">Training Sessions:</h3>
                        <ul class="list-disc ml-5">
                            @foreach($class->trainsessions as $session)
                                <li class="text-gray-600">{{ $session->session_date }} - {{ $session->session_time }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p class="text-gray-600">No training sessions scheduled yet.</p>
                @endif
    
                <!-- Action Buttons -->
                <div class="flex justify-end mt-6">
                    <a href="{{ route('classes.edit', $class->id) }}" class="text-orange-600 hover:text-orange-500 mr-4">Edit</a>
                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-500">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
</x-layout>