<x-layout>

    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    {{-- <x-slot:userID>{{ $id }}</x-slot:userID> --}}
    <x-slot:bgColor>{{ 'bg-black' }}</x-slot:bgColor>

    <div class="flex items-center justify-center bg-cover bg-center h-[780px]" style="background-image: url('https://images.pexels.com/photos/1331750/pexels-photo-1331750.jpeg?cs=srgb&dl=4k-wallpaper-backlit-basketball-1331750.jpg&fm=jpg');">
        <h1 class="font-bold text-4xl text-white p-6 bg-opacity-50 bg-black rounded-lg">Welcome Name</h1>
    </div>

    <div>
        <h1 class="h-[1700px]">a</h1>
    </div>


</x-layout>

{{-- <img src="https://static.vecteezy.com/system/resources/previews/018/722/990/original/hand-drawn-flame-silhouette-on-transparent-background-free-png.png" 
             alt="Image" 
             class="rotate-90 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
    > --}}