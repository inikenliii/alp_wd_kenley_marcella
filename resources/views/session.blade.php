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
        
        <!-- Create Button (visible only for admins) -->
        @if (Auth::user()->isAdmin)
            <div class="flex justify-center mb-6">
                <button id="create-session-btn" class="px-6 py-2 text-lg font-semibold text-white bg-green-500 rounded-lg hover:bg-green-600">
                    + Create Train Session
                </button>
            </div>
        @endif

        <!-- My Sessions -->
        <div id="mySessions" class="flex flex-col gap-y-2 mt-8">
            @forelse ($userSessions as $trainses)
                <div class="w-full flex items-center rounded-xl p-4 bg-white">
                    <img src="{{ asset($trainses->image) }}" alt="Session image"
                        class="w-12 h-12 rounded-full object-cover" />
                    <div class="flex flex-col mx-8">
                        <span class="text-md font-bold">{{ $trainses->classs->class_name }}</span> <!-- Access 'class_name' for the class -->
                        <span class="text-sm text-gray-400">{{ $trainses->user->name }}</span>
                    </div>
                    <div class="flex flex-col mx-8">
                        <span class="text-md text-gray-400">{{ date('d M Y', strtotime($trainses->trainsession_date)) }}</span>
                        <span class="text-sm text-gray-400">{{ date('H:i', strtotime($trainses->start_time)) }} - {{ date('H:i', strtotime($trainses->end_time)) }}</span>
                    </div>
                    <span class="text-md text-gray-400 mx-8 flex-grow">{{ $trainses->description }}</span>
                </div>
            @empty
                <h3 class="text-5xl mt-8 font-semibold text-orange-300/50 text-center">You have no train sessions.</h3>
            @endforelse
        </div>

        <!-- All Sessions -->
        <div id="allSessions" class="hidden flex flex-col gap-y-2 mt-8">
            @foreach ($allSessions as $session)
                <div class="w-full flex items-center rounded-xl p-4 bg-white">
                    <img src="{{ asset($session->image) }}" alt="Session image"
                        class="w-12 h-12 rounded-full object-cover" />
                    <div class="flex flex-col mx-8">
                        <span class="text-md font-bold">{{ $session->classs->class_name }}</span>
                        <span class="text-sm text-gray-400">{{ $session->user->name }}</span>
                    </div>
                    <div class="flex flex-col mx-8">
                        <span class="text-md text-gray-400">{{ date('d M Y', strtotime($session->trainsession_date)) }}</span>
                        <span class="text-sm text-gray-400">{{ date('H:i', strtotime($session->start_time)) }} - {{ date('H:i', strtotime($session->end_time)) }}</span>
                    </div>
                    <span class="text-md text-gray-400 mx-8 flex-grow">{{ $session->description }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Create TrainSession Modal -->
    <div id="create-session-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-yellow-50 p-8 rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-auto">
            <h2 class="text-2xl font-semibold text-orange-800 mb-6">Create Train Session</h2>
            <form method="POST" action="{{ route('session.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Class -->
                <div class="mt-4">
                    <label for="class_id" class="block text-lg font-medium text-orange-800">Class</label>
                    <select name="class_id" id="class_id" class="w-full p-3 border border-orange-200 rounded-lg">
                        @foreach ($allClasses as $class) <!-- Loop through all classes -->
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- User -->
                <div class="mt-4">
                    <label for="user_id" class="block text-lg font-medium text-orange-800">Trainer</label>
                    <select name="user_id" id="user_id" class="w-full p-3 border border-orange-200 rounded-lg">
                        @foreach ($users as $trainer) <!-- Loop through all users -->
                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Image -->
                <div class="mt-4">
                    <label for="image" class="block text-lg font-medium text-orange-800">Session Image</label>
                    <input type="file" name="image" id="image" class="w-full p-3 border border-orange-200 rounded-lg">
                </div>

                <!-- Date -->
                <div class="mt-4">
                    <label for="trainsession_date" class="block text-lg font-medium text-orange-800">Date</label>
                    <input type="date" name="trainsession_date" class="w-full p-3 border border-orange-200 rounded-lg">
                </div>

                <!-- Start Time -->
                <div class="mt-4">
                    <label for="start_time" class="block text-lg font-medium text-orange-800">Start Time</label>
                    <input type="time" name="start_time" class="w-full p-3 border border-orange-200 rounded-lg">
                </div>

                <!-- End Time -->
                <div class="mt-4">
                    <label for="end_time" class="block text-lg font-medium text-orange-800">End Time</label>
                    <input type="time" name="end_time" class="w-full p-3 border border-orange-200 rounded-lg">
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <label for="description" class="block text-lg font-medium text-orange-800">Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full p-3 border border-orange-200 rounded-lg"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-between">
                    <button type="submit" class="w-2/4 p-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600">
                        Create Session
                    </button>
                    <button type="button" id="cancel-create-modal" class="w-1/3 p-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to handle modal and toggle between sessions -->
    <script>
        // Toggle visibility for My Sessions and All Sessions
        document.getElementById('mySessionsBtn').addEventListener('click', function () {
            document.getElementById('mySessions').classList.remove('hidden');
            document.getElementById('allSessions').classList.add('hidden');
        });

        document.getElementById('allSessionsBtn').addEventListener('click', function () {
            document.getElementById('allSessions').classList.remove('hidden');
            document.getElementById('mySessions').classList.add('hidden');
        });

        // Show Create Train Session Modal
        document.getElementById('create-session-btn').addEventListener('click', function () {
            document.getElementById('create-session-modal').classList.remove('hidden');
        });

        // Hide Create Train Session Modal
        document.getElementById('cancel-create-modal').addEventListener('click', function () {
            document.getElementById('create-session-modal').classList.add('hidden');
        });
    </script>
</x-layout>
