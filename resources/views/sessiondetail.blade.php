<x-layout>
    <x-slot:headerTitle>{{ $pagetitle }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-black' }}</x-slot:bgColor>

    <div class="min-h-screen text-gray-100">
        <!-- Header Section -->
        <div class="relative">
            <img src="{{ asset($trainSession->image ?: '/images/backlit-basketball.jpg') }}" 
                alt="Train Session Banner" 
                class="w-full h-96 xl:h-[550px] object-cover opacity-70" />
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black"></div>
            <div class="absolute bottom-12 left-8">
                <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-red-500">
                    {{ $trainSession->classs->class_name }}
                </h1>
                <p class="text-6xl bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-red-500 font-semibold mt-2">{{ $trainSession->user->name }}</p>
            </div>
        </div>

        <!-- Details Section -->
        <div class="px-8 py-12">
            <!-- Date & Time -->
            <div class="column items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-xl font-bold text-orange-400">Date:</span>
                    <span class="text-lg font-semibold text-orange-100">{{ date('d M Y', strtotime($trainSession->trainsession_date)) }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xl font-bold text-orange-400">Time:</span>
                    <span class="text-lg font-semibold text-orange-100">
                        {{ date('H:i', strtotime($trainSession->start_time)) }} - {{ date('H:i', strtotime($trainSession->end_time)) }}
                    </span>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-8">
                <h2 class="text-2xl font-semibold text-orange-400">Description</h2>
                <p class="text-lg mt-2 text-orange-100">
                    {{ $trainSession->description }}
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="px-8 py-6 flex space-x-4 items-center">
            <a href="{{ route('session.show', Auth::id()) }}" 
                class="px-6 py-3 mr-4 bg-orange-900 text-orange-300 rounded-lg hover:bg-orange-950">
                Back to Sessions
            </a>
            @if (Auth::check() && Auth::user()->isAdmin)
                <a href="" 
                    class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700">
                    Edit Session
                </a>
                <form method="POST" action="{{ route('session.destroy', $trainSession->id) }}" 
                    onsubmit="return confirm('Are you sure you want to delete this session?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="px-6 py-3 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700">
                        Delete Session
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-layout>
