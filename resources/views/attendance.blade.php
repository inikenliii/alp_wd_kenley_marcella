<x-layout>
    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-orange-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ $id }}</x-navbar>
    </div>
    
    <div class="mb-20"></div>

    <div class="p-4">
        <h1 class="text-7xl font-bold text-orange-300 text-center">Attendance List</h1>
        <div class="mb-16"></div>

        <!-- Attendance Cards -->
        <div class="flex flex-col gap-y-2 mt-8">
            @forelse ($attendances as $attend)
                <div class="w-full flex items-center rounded-xl p-4 bg-white shadow-md">
                    <img src="{{ asset('/images/user_profile.png') }}" alt="User profile"
                        class="w-12 h-12 rounded-full" />
                    <div class="flex flex-col ml-4">
                        <span class="text-md font-bold">ID: {{ $attend->id }}</span>
                        <span class="text-md text-gray-600">User ID: {{ $attend->user_id }}</span>
                        <span class="text-md text-gray-600">Train Session ID: {{ $attend->trainsession_id }}</span>
                        <span class="text-md text-gray-600">Status: {{ $attend->attendance_status }}</span>
                        <span class="text-md text-gray-600">Date: {{ $attend->attendance_date }}</span>
                    </div>
                </div>
            @empty
                <h1 class="text-5xl font-bold text-orange-300/50 text-center">No attendance records found.</h1>
            @endforelse
        </div>
    </div>
</x-layout>
