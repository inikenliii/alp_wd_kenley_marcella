<x-layout>

    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    {{-- <x-slot:userID>{{ $id }}</x-slot:userID> --}}
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>
    
    <div class="mb-20"></div>

    <div class="p-4">
        <h1 class="text-7xl font-bold text-orange-300 text-center">Session List</h1>
        <div class="mb-16"></div>
        
        <div class="grid grid-cols-2 gap-4">
            
            <a href="/test">
                <div class="bg-white p-8 rounded-md w-full">
                    <img class="w-full rounded-md" src="https://images.pexels.com/photos/1331750/pexels-photo-1331750.jpeg?cs=srgb&dl=4k-wallpaper-backlit-basketball-1331750.jpg&fm=jpg" alt="Session Image" />
                        <h1 class="text-2xl font-bold text-amber-700">Session Name</h1>
                        <h1 class="text-2xl font-bold text-amber-700">Session Name</h1>
                </div>
            </a>

            <a href="/test">
                <div class="bg-white p-8 rounded-md w-full">
                    <img class="w-full rounded-md" src="https://images.pexels.com/photos/1331750/pexels-photo-1331750.jpeg?cs=srgb&dl=4k-wallpaper-backlit-basketball-1331750.jpg&fm=jpg" alt="Session Image" />
                        <h1 class="text-2xl font-bold text-amber-700">Session Name</h1>
                        <h1 class="text-2xl font-bold text-amber-700">Session Name</h1>
                </div>
            </a>

            <a href="/test">
                <div class="bg-white p-8 rounded-md w-full">
                    <img class="w-full rounded-md" src="https://images.pexels.com/photos/1331750/pexels-photo-1331750.jpeg?cs=srgb&dl=4k-wallpaper-backlit-basketball-1331750.jpg&fm=jpg" alt="Session Image" />
                        <h1 class="text-2xl font-bold text-amber-700">Session Name</h1>
                        <h1 class="text-2xl font-bold text-amber-700">Session Name</h1>
                </div>
            </a>

        </div>
    </div>

</x-layout>