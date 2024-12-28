<x-layout>
    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ $id }}</x-navbar>
    </div>
    
    <div class="mb-20"></div>

    <div class="p-4">
        <h1 class="text-7xl font-bold text-orange-300 text-center">Session List</h1>
        <div class="mb-16"></div>
        
        <!-- Training Session Cards -->
        <div class="flex flex-col gap-y-2 mt-8 student-list">
            @forelse ($sessions as $trainses)
                <a href="{{ route('session.show', $trainses->id) }}" class="w-full flex items-center rounded-xl p-4 bg-white">
                    <img src="{{ asset($trainses->image) }}" alt="Session image"
                        class="w-12 h-12 rounded-full object-cover" />
                    <div class="flex flex-col mx-8">
                        <span class="text-md font-bold">{{ $trainses->classs->name }}</span>
                        <span class="text-sm text-gray-400">{{ $trainses->user->name }}</span>
                    </div>
                    <div class="flex flex-col mx-8">
                        <span class="text-md text-gray-400">{{ date('d M Y', strtotime($trainses->trainsession_date)) }}</span>
                        <span class="text-sm text-gray-400">{{ date('H:i', strtotime($trainses->start_time)) }} - {{ date('H:i', strtotime($trainses->end_time)) }}</span>
                    </div>
                    <span class="text-md text-gray-400 mx-8 flex-grow">{{ $trainses->description }}</span>
                </a>
            @empty
                <p class="text-center text-gray-500">No Train Session found.</p>
            @endforelse
        </div>
    </div>

</x-layout>