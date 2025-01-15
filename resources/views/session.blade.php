<x-layout>
    <x-slot:headerTitle>{{ $pagetitle }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-orange-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ $id }}</x-navbar>
    </div>

    <div class="mb-20"></div>

    <div class="p-4">
        <h1 class="text-7xl font-bold text-orange-300 text-center">Train Sessions</h1>
        <div class="mb-16"></div>
        
        @if (Auth::check() && Auth::user()->isAdmin)
            <div class="flex justify-center mb-6">

                <!-- Class Filter ropdown (visible only for admins) -->
                <select id="classFilter" class="w-full p-2 border border-orange-400 rounded-lg bg-orange-50 text-orange-900">
                    <option value="all">All Classes</option>
                    @foreach ($allClasses as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>

                <!-- Create Button (visible only for admins) -->
                <button id="create-session-btn" class="px-6 w-2/12 ml-4 text-lg font-bold text-white bg-green-500 rounded-lg hover:bg-green-600">
                    + Create
                </button>

            </div>
        @endif

        <!-- All Sessions -->
        <div id="allSessions" class="flex flex-col gap-y-2 mt-8">
            @forelse ($trainSessions as $session)
                <a href="/classs/{{ $session->id }}">
                    <div class="w-full flex items-center rounded-xl p-4 bg-orange-50">
                        <img src="{{ asset($session->image ?: '/images/backlit-basketball.jpg') }}" alt="Session image"
                            class="w-1/12 h-16 rounded-lg object-cover" />
                        <div class="flex flex-col mx-8 w-1/5">
                            <span class="text-md font-bold text-orange-950">{{ $session->classs->class_name }}</span>
                            <span class="text-sm text-orange-900">{{ $session->user->name }}</span>
                        </div>
                        <div class="flex flex-col mx-8 w-2/12">
                            <span class="text-md text-orange-900">{{ date('d M Y', strtotime($session->trainsession_date)) }}</span>
                            <span class="text-sm text-orange-900">{{ date('H:i', strtotime($session->start_time)) }} - {{ date('H:i', strtotime($session->end_time)) }}</span>
                        </div>
                        <p class="mt-2 text-orange-900 text-sm truncate w-7/12">{{ $session->description }}</p>
                    </div>
                </a>
            @empty
                <h1 class="text-5xl font-bold text-orange-300/50 text-center">No Train Session records found.</h1>
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



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Elements
            const createSessionBtn = document.getElementById('create-session-btn');
            const createSessionModal = document.getElementById('create-session-modal');
            const cancelCreateModalBtn = document.getElementById('cancel-create-modal');
            const classFilter = document.getElementById('classFilter');
            const filteredSessionsContainer = document.getElementById('allSessions');
            const allSessionsData = @json($trainSessions); // Pass PHP data to JavaScript

            // Helper Function: Log missing elements and abort if necessary
            function checkElementsExist(elements) {
                for (const [key, element] of Object.entries(elements)) {
                    if (!element) {
                        console.error(`Missing element: ${key}. Check your HTML.`);
                        return false;
                    }
                }
                return true;
            }

            // Ensure all required elements exist
            if (!checkElementsExist({
                createSessionBtn,
                createSessionModal,
                cancelCreateModalBtn,
                classFilter,
                filteredSessionsContainer
            })) {
                return; // Abort if essential elements are missing
            }

            // Function to Filter Sessions by Class
            function filterSessionsByClass(classId) {
                // Clear the current session list
                filteredSessionsContainer.innerHTML = '';

                // Filter sessions based on classId
                const filteredSessions = classId === 'all'
                    ? allSessionsData // Show all sessions
                    : allSessionsData.filter(session => session.class_id == classId); // Match class_id

                // Check if filtered sessions exist
                if (filteredSessions.length > 0) {
                    filteredSessions.forEach(session => {
                        // Create link element
                        const linkElement = document.createElement('a');
                        linkElement.href = `/classs/${session.id}`;
                        linkElement.classList.add('w-full');

                        // Create a session card
                        const sessionElement = document.createElement('div');
                        sessionElement.classList.add('w-full', 'flex', 'items-center', 'rounded-xl', 'p-4', 'bg-orange-50');
                        sessionElement.innerHTML = `
                            <img src="/storage/${session.image}" class="w-1/12 h-16 rounded-lg object-cover">
                            <div class="flex flex-col mx-8 w-1/12 h-16">
                                <span class="text-md font-bold text-orange-950">${session.classs.class_name}</span>
                                <span class="text-sm text-orange-900">${session.user.name}</span>
                            </div>
                            <div class="flex flex-col mx-8 w-2/12">
                                <span class="text-md text-orange-900">${session.trainsession_date}</span>
                                <span class="text-sm text-orange-900">${session.start_time} - ${session.end_time}</span>
                            </div>
                            <span class="text-md text-orange-900 mx-8 flex-grow truncate w-7/12">${session.description}</span>
                        `;
                        // Append the session to the container
                        filteredSessionsContainer.appendChild(sessionElement);
                    });
                } else {
                    // Show "no sessions available" message
                    filteredSessionsContainer.innerHTML = `
                        <h3 class="text-5xl mt-8 font-bold text-orange-300/50 text-center">
                            No sessions available for this class
                        </h3>
                    `;
                }
            }

            // Event Listener for Class Filter Dropdown
            classFilter.addEventListener('change', function () {
                const classId = this.value;
                filterSessionsByClass(classId);
            });

            // Show/Hide Create Session Modal
            createSessionBtn.addEventListener('click', function () {
                createSessionModal.classList.remove('hidden');
            });
            cancelCreateModalBtn.addEventListener('click', function () {
                createSessionModal.classList.add('hidden');
            });
        });
    </script>
</x-layout>