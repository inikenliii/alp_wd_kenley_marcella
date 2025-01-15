<x-layout>
    <x-slot:headerTitle>{{ $pagetitle }}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-black' }}</x-slot:bgColor>

    <div class="min-h-screen">
        <!-- Header Section -->
        <div class="relative">
            <img src="{{ asset($trainSession->image ?: '/images/backlit-basketball.jpg') }}" 
                alt="Train Session Banner" 
                class="w-full h-96 xl:h-[550px] object-cover opacity-70" />
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black"></div>
            <div class="absolute bottom-4 left-8">
                <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-red-500">
                    {{ $trainSession->classs->class_name }}
                </h1>
                <p class="text-8xl p-4 bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-red-500 font-semibold mt-2">{{ $trainSession->user->name }}</p>
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
                    {!! nl2br(e($trainSession->description)) !!}     {{-- nl2br means accept enter --}}
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
                <!-- Create Payment Button -->
                <button id="create-payment-button" class="px-6 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700">
                    Create Payment
                </button>

                <button id="edit-button" 
                    class="px-6 py-3 bg-yellow-600 text-white font-bold rounded-lg hover:bg-yellow-700">
                    Edit Session
                </button>

                <form method="POST" action="{{ route('session.destroy', $trainSession->id) }}" 
                    onsubmit="return confirm('Are you sure you want delete this session?')">
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

    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <!-- Edit TrainSession Modal -->
    <div id="edit-session-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-yellow-50 p-8 rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-auto">
            <h2 class="text-2xl font-semibold text-orange-800 mb-6">Edit Train Session</h2>
            <form method="POST" action="{{ route('session.update', $trainSession->id) }}" onsubmit="alert('Payment created successfully!');" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
            
                <!-- Class -->
                <div class="mt-4">
                    <label for="class_id" class="block text-lg font-medium text-orange-800">Class</label>
                    <select name="class_id" id="class_id" class="w-full p-3 border @error('class_id') border-red-500 @else border-orange-200 @enderror rounded-lg">
                        @foreach ($allClasses as $class)
                            <option value="{{ $class->id }}" 
                                {{ $trainSession->class_id == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mt-4">
                    <label for="image" class="block text-lg font-medium text-orange-800">Session Image</label>
                    <input type="file" name="image" id="image" class="w-full p-3 border @error('image') border-red-500 @else border-orange-200 @enderror rounded-lg">
                    @if ($trainSession->image)
                        <p class="text-sm text-orange-600 mt-2">Current Image: <img src="{{ asset($trainSession->image) }}" alt="Current Image" class="h-20 w-20 rounded-md object-cover"></p>
                    @endif
                    @error('image')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date -->
                <div class="mt-4">
                    <label for="trainsession_date" class="block text-lg font-medium text-orange-800">Date</label>
                    <input type="date" name="trainsession_date" class="w-full p-3 border @error('trainsession_date') border-red-500 @else border-orange-200 @enderror rounded-lg" value="{{ old('trainsession_date', $trainSession->trainsession_date) }}">
                    @error('trainsession_date')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Start Time -->
                <div class="mt-4">
                    <label for="start_time" class="block text-lg font-medium text-orange-800">Start Time</label>
                    <input type="time" name="start_time" class="w-full p-3 border @error('start_time') border-red-500 @else border-orange-200 @enderror rounded-lg" 
                        value="{{ old('start_time', $trainSession->start_time ? date('H:i', strtotime($trainSession->start_time)) : '') }}">
                    @error('start_time')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Time -->
                <div class="mt-4">
                    <label for="end_time" class="block text-lg font-medium text-orange-800">End Time</label>
                    <input type="time" name="end_time" class="w-full p-3 border @error('end_time') border-red-500 @else border-orange-200 @enderror rounded-lg" 
                        value="{{ old('end_time', $trainSession->end_time ? date('H:i', strtotime($trainSession->end_time)) : '') }}">
                    @error('end_time')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <label for="description" class="block text-lg font-medium text-orange-800">Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full p-3 border @error('description') border-red-500 @else border-orange-200 @enderror rounded-lg">{{ old('description', $trainSession->description) }}</textarea>
                    @error('description')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- Submit Button -->
                <div class="mt-8 flex justify-between">
                    <button type="submit" class="w-2/4 p-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600">
                        Update Session
                    </button>
                    <button type="button" id="cancel-edit-modal" class="w-1/3 p-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Payment Modal -->
    <div id="create-payment-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-yellow-50 p-8 rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-auto">

            <h2 class="text-2xl font-semibold text-orange-800 mb-6">Create Payment</h2>
            <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Session ID (hidden) -->
                <input type="hidden" name="session_id" value="{{ $trainSession->id }}">

                <!-- User ID (hidden and pre-filled with trainSession user_id) -->
                <input type="hidden" name="user_id" value="{{ $trainSession->user_id }}">

                <!-- Amount -->
                <div class="mt-4">
                    <label for="amount" class="block text-lg font-medium text-orange-800">Amount</label>
                    <input type="number" name="amount" class="w-full p-3 border @error('amount') border-red-500 @else border-orange-200 @enderror rounded-lg" value="">
                    @error('amount')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Payment Date -->
                <div class="mt-4">
                    <label for="payment_date" class="block text-lg font-medium text-orange-800">Payment Date</label>
                    <input type="date" name="payment_date" class="w-full p-3 border @error('payment_date') border-red-500 @else border-orange-200 @enderror rounded-lg" value="">
                    @error('payment_date')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-between">
                    <button type="submit" class="w-2/4 p-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600">
                        Create Payment
                    </button>
                    <button type="button" id="cancel-create-payment-modal" class="w-1/3 p-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">
                        Cancel
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.getElementById('edit-button').addEventListener('click', () => {
            document.getElementById('edit-session-modal').classList.remove('hidden');
        });
        document.getElementById('cancel-edit-modal').addEventListener('click', () => {
            document.getElementById('edit-session-modal').classList.add('hidden');
        });

        document.getElementById('create-payment-button').addEventListener('click', () => {
            document.getElementById('create-payment-modal').classList.remove('hidden');
        });
        document.getElementById('cancel-create-payment-modal').addEventListener('click', () => {
            document.getElementById('create-payment-modal').classList.add('hidden');
        });

    </script>

</x-layout>
