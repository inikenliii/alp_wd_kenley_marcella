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

        <div class="flex flex-col gap-y-2 mt-8">
            @forelse ($attendances as $atnd)
                    <div class="w-full flex items-center rounded-xl p-4 bg-orange-50">
                        {{-- User Profile --}}
                        <img 
                            src="{{ $atnd->user && $atnd->user->image_profile == 0 
                                ? asset('/images/user_profile.webp')
                                : asset($atnd->user->image_profile) }}" 
                            alt="User profile" 
                            class="w-12 h-12 rounded-full border border-orange-900"
                        />

                        {{-- Date, payment status, amount --}}
                        <div class="flex flex-col ml-4 mr-4 w-full">
                            <div class="flex justify-between">
                                <div class="flex flex-col justify-center">
                                    <span class="text-md text-orange-900">{{ $atnd->trainsession }}</span>
                                    <span class="text-md text-orange-900">{{ date('d F Y', strtotime($atnd->month_paid)) }}</span>
                                </div>
                                    
                                    <div class="flex flex-col justify-center w-1/4 xl:w-1/12">
                                        <div class="flex mb-1">
                                            <span class="text-md text-orange-900 font-medium">Status: </span>
                                            <span class="text-md {{ $atnd->attendance_status === 'pending' ? 'text-red-600' : 'text-green-600' }} font-bold">{{ $atnd->attendance_status }}</span>
                                        </div>
                                        
                                        <form 
                                            action="{{ $atnd->attendance_status === 'pending' ? route('attendance.update', $pymt->id) : route('attendance.destroy', $atnd->id) }}" 
                                            method="POST"
                                            onsubmit="return $atnd->attendance_status === 'pending' ? true : confirm('Are you sure you want to delete this attendance?')"
                                        >
                                            @csrf
                                            @if($atnd->attendance_status === 'pending')
                                                @method('PATCH')
                                            @else
                                                @method('DELETE')
                                            @endif
                                            <button 
                                                type="submit" 
                                                class="{{ $atnd->attendance_status === 'pending' ? 'bg-orange-500 text-white hover:bg-orange-700' : 'bg-red-500 text-white hover:bg-red-700' }} font-bold py-1 px-2 rounded-md w-full"
                                            >
                                                {{ $atnd->attendance_status === 'pending' ? 'To Paid' : 'Delete' }}
                                            </button>
                                        </form>
                                    </div>
                                
                            </div>
                        </div>

                        
                    </div>
            @empty
                <h1 class="text-5xl font-bold text-orange-300/50 text-center">No attendance records found.</h1>
            @endforelse
        </div>
    </div>
</x-layout>
