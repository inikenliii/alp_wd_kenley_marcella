<x-layout>

    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-orange-950' }}</x-slot:bgColor>

    <div class="min-h-full">
        <x-navbar>{{ $id }}</x-navbar>
    </div>
    
    <div class="mb-20"></div>

    <div class="p-4">
        <h1 class="text-7xl font-bold text-orange-300 text-center">Payment</h1>
        <div class="mb-16"></div>

        <div class="flex flex-col gap-y-2 mt-8">
            @forelse ($payment as $pymt)
                    <div class="w-full flex items-center rounded-xl p-4 bg-orange-50">
                        {{-- User Profile --}}
                        <img 
                            src="{{ $pymt->user && $pymt->user->image_profile == 0 
                                ? asset('/images/user_profile.webp')
                                : asset($pymt->user->image_profile) }}" 
                            alt="User profile" 
                            class="w-12 h-12 rounded-full border border-orange-900"
                        />

                        {{-- Date, payment status, amount --}}
                        <div class="flex flex-col ml-4 mr-4 w-full">
                            <div class="flex justify-between">
                                <div class="flex flex-col justify-center">
                                    <span class="text-md text-orange-900">{{ date('d F Y', strtotime($pymt->month_paid)) }}</span>
                                    <span class="text-md text-orange-900">Rp.{{ number_format($pymt->amount, 0, ',', '.') }}</span>
                                </div>

                                <div class="flex flex-col justify-center w-1/4 xl:w-1/12">
                                    <div class="flex mb-1">
                                        <span class="text-md text-orange-900 font-medium">Status: </span>
                                        <span class="text-md {{ $pymt->payment_status === 'pending' ? 'text-red-600' : 'text-green-600' }} font-bold">{{ $pymt->payment_status }}</span>
                                    </div>
                                    
                                    <form action="{{ route('payment.update', $pymt->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button 
                                            type="submit" 
                                            class="{{ $pymt->payment_status === 'pending' ? 'bg-orange-500 text-white hover:bg-orange-700' : 'bg-orange-700 text-orange-900'}} font-bold py-1 px-2 rounded-md w-full"
                                        >
                                            {{ $pymt->payment_status === 'pending' ? 'To Paid' : 'Paid' }}
                                        </button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>

                        
                    </div>
            @empty
                <h1 class="text-5xl font-bold text-orange-300/50 text-center">No payment records found.</h1>
            @endforelse
        </div>

    </div>

</x-layout>