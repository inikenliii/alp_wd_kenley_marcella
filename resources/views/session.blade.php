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
        
        @if (Auth::user()->isAdmin)
            <!-- Switch for toggling views (visible only for admins) -->
            <div class="flex mb-6">
                <button id="mySessionsBtn" class="px-6 py-2 text-lg font-semibold text-white bg-orange-500 rounded-l-lg hover:bg-orange-600">
                    My Sessions
                </button>
                <button id="allSessionsBtn" class="px-6 py-2 text-lg font-semibold text-orange-500 bg-orange-200 rounded-r-lg hover:bg-orange-300">
                    All Sessions
                </button>
            </div>

            <!-- Create Button (visible only for admins) -->
            <div class="flex justify-center mb-6">
                <button id="create-session-btn" class="px-6 py-2 text-lg font-semibold text-white bg-green-500 rounded-lg hover:bg-green-600">
                    + Create Train Session
                </button>
            </div>

            <!-- Class Filter Dropdown -->
            <select id="classFilter" class="w-full p-3 border border-orange-200 rounded-lg hidden">
                <option value="all">All Classes</option>
                @foreach ($allClasses as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                @endforeach
            </select>

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
                <h3 class="text-5xl mt-8 font-bold text-orange-300/50 text-center">You have no train sessions</h3>
            @endforelse
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
        document.addEventListener('DOMContentLoaded', function () {
    // Button and view elements
    const mySessionsBtn = document.getElementById('mySessionsBtn');
    const allSessionsBtn = document.getElementById('allSessionsBtn');
    const mySessions = document.getElementById('mySessions');
    const allSessions = document.getElementById('allSessions');
    const createSessionBtn = document.getElementById('create-session-btn');
    const createSessionModal = document.getElementById('create-session-modal');
    const cancelCreateModalBtn = document.getElementById('cancel-create-modal');
    const classFilter = document.getElementById('classFilter');
    const filteredSessionsContainer = document.createElement('div'); // Container for filtered sessions
    const allSessionsData = @json($allSessions);

    // Append the filtered sessions container to the DOM (only if not already present)
    if (!document.getElementById('filteredSessions')) {
        filteredSessionsContainer.id = 'filteredSessions';
        filteredSessionsContainer.classList.add('hidden', 'flex', 'flex-col', 'gap-y-2', 'mt-8');
        allSessions.parentNode.appendChild(filteredSessionsContainer);
    }

    // Helper function: Ensure elements exist
    function checkElementsExist(elements) {
        for (const [key, value] of Object.entries(elements)) {
            if (!value) {
                console.error(`Missing element: ${key}. Check your HTML.`);
                return false;
            }
        }
        return true;
    }

    if (!checkElementsExist({ mySessionsBtn, allSessionsBtn, mySessions, allSessions, createSessionBtn, createSessionModal, cancelCreateModalBtn, classFilter })) {
        return; // Stop execution if elements are missing
    }

    // Function to toggle visibility of sessions and elements
    function toggleSessions(showMySessions) {
        if (showMySessions) {
            // Show My Sessions
            mySessions.classList.remove('hidden');
            allSessions.classList.add('hidden');
            filteredSessionsContainer.classList.add('hidden');

            // Update button styles
            mySessionsBtn.classList.add('bg-orange-500', 'text-white');
            mySessionsBtn.classList.remove('bg-orange-200', 'text-orange-500');
            allSessionsBtn.classList.add('bg-orange-200', 'text-orange-500');
            allSessionsBtn.classList.remove('bg-orange-500', 'text-white');

            // Show Create Button, hide Class Filter
            createSessionBtn.classList.remove('hidden');
            classFilter.classList.add('hidden');
        } else {
            // Show All Sessions
            allSessions.classList.remove('hidden');
            mySessions.classList.add('hidden');
            filteredSessionsContainer.classList.add('hidden');

            // Update button styles
            allSessionsBtn.classList.add('bg-orange-500', 'text-white');
            allSessionsBtn.classList.remove('bg-orange-200', 'text-orange-500');
            mySessionsBtn.classList.add('bg-orange-200', 'text-orange-500');
            mySessionsBtn.classList.remove('bg-orange-500', 'text-white');

            // Show Class Filter, hide Create Button
            createSessionBtn.classList.add('hidden');
            classFilter.classList.remove('hidden');
        }
    }

    // Event listeners for toggling sessions
    mySessionsBtn.addEventListener('click', () => toggleSessions(true));
    allSessionsBtn.addEventListener('click', () => toggleSessions(false));

    // Show and hide the create session modal
    createSessionBtn.addEventListener('click', function () {
        createSessionModal.classList.remove('hidden');
    });

    cancelCreateModalBtn.addEventListener('click', function () {
        createSessionModal.classList.add('hidden');
    });

    // Function to filter sessions by class
    function filterSessionsByClass(classId) {
        filteredSessionsContainer.innerHTML = ''; // Clear previous sessions

        const filteredSessions = classId === 'all'
            ? allSessionsData
            : allSessionsData.filter(session => session.class_id == classId);

        if (filteredSessions.length > 0) {
            filteredSessions.forEach(session => {
                const sessionElement = document.createElement('div');
                sessionElement.classList.add('w-full', 'flex', 'items-center', 'rounded-xl', 'p-4', 'bg-white');
                sessionElement.innerHTML = `
                    <img src="${session.image}" alt="Session image" class="w-12 h-12 rounded-full object-cover" />
                    <div class="flex flex-col mx-8">
                        <span class="text-md font-bold">${session.classs.class_name}</span>
                        <span class="text-sm text-gray-400">${session.user.name}</span>
                    </div>
                    <div class="flex flex-col mx-8">
                        <span class="text-md text-gray-400">${session.trainsession_date}</span>
                        <span class="text-sm text-gray-400">${session.start_time} - ${session.end_time}</span>
                    </div>
                    <span class="text-md text-gray-400 mx-8 flex-grow">${session.description}</span>
                `;
                filteredSessionsContainer.appendChild(sessionElement);
            });
        }
        else {
            filteredSessionsContainer.innerHTML = '<h3 class="text-5xl mt-8 font-bold text-orange-300/50 text-center">No sessions available for this class</h3>';
        }

        // Show filtered sessions, hide others
        allSessions.classList.add('hidden');
        mySessions.classList.add('hidden');
        filteredSessionsContainer.classList.remove('hidden');
    }

    // Event listener for class filter dropdown
    classFilter.addEventListener('change', function () {
        const classId = this.value;
        filterSessionsByClass(classId);
    });
});
    </script>
</x-layout>
