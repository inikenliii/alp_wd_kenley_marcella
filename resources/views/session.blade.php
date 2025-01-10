<x-layout>
    <x-slot:headerTitle>{{ $pagetitle }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ $id }}</x-navbar>
    </div>
    
    <div class="mb-20"></div>

    <div class="p-4">
        <h1 class="text-7xl font-bold text-orange-300 text-center">Train Sessions</h1>
        <div class="mb-8"></div>

        <!-- Switch for toggling views -->
        <div class="flex mb-6">
            <button id="mySessionsBtn" class="px-6 py-2 text-lg font-semibold text-white bg-orange-500 rounded-l-lg hover:bg-orange-600">
                My Sessions
            </button>
            <button id="allSessionsBtn" class="px-6 py-2 text-lg font-semibold text-orange-500 bg-orange-200 rounded-r-lg hover:bg-orange-300">
                All Sessions
            </button>
        </div>

        <!-- My Sessions -->
        <div id="mySessions" class="flex flex-col gap-y-2 mt-8">
            @forelse ($userSessions as $trainses)
                <div class="w-full flex items-center rounded-xl p-4 bg-white">
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
                </div>
            @empty
                <h3 class="text-3xl font-semibold text-orange-300/50 text-center">You have no train sessions.</h3>
            @endforelse
        </div>

        <!-- All Sessions -->
        <div id="allSessions" class="flex flex-col gap-y-2 mt-8 hidden">
            @forelse ($allSessions as $trainses)
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
                <h3 class="text-3xl font-semibold text-orange-300/50 text-center">No train sessions found.</h3>
            @endforelse
        </div>
    </div>

    <script>
        // JavaScript to handle toggle
        document.getElementById('mySessionsBtn').addEventListener('click', function () {
            document.getElementById('mySessions').classList.remove('hidden');
            document.getElementById('allSessions').classList.add('hidden');
            this.classList.add('bg-orange-500', 'text-white');
            this.classList.remove('bg-orange-200', 'text-orange-500');
            document.getElementById('allSessionsBtn').classList.remove('bg-orange-500', 'text-white');
            document.getElementById('allSessionsBtn').classList.add('bg-orange-200', 'text-orange-500');
        });

        document.getElementById('allSessionsBtn').addEventListener('click', function () {
            document.getElementById('allSessions').classList.remove('hidden');
            document.getElementById('mySessions').classList.add('hidden');
            this.classList.add('bg-orange-500', 'text-white');
            this.classList.remove('bg-orange-200', 'text-orange-500');
            document.getElementById('mySessionsBtn').classList.remove('bg-orange-500', 'text-white');
            document.getElementById('mySessionsBtn').classList.add('bg-orange-200', 'text-orange-500');
        });
    </script>
</x-layout>
