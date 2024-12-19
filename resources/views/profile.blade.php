<x-layout>

    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    <x-slot:userID>{{ (int) request('id') }}</x-slot:userID>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="mb-20"></div>

    <div class="flex p-8">
        <div class="flex-1">
            <img class="size-full rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </div>

        <div class="flex-2 mr-24"></div>
        
        <div class="flex-1">
            <h1 class="text-orange-200 text-7xl font-bold">{{ $user->name }}</h1>
            <div class="flex-2 mb-8"></div>

            <h1 class="text-orange-200 text-3xl font-medium">Username: {{ $user->username }}</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Address: {{ $user->address }}</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Phone Number: +{{ $user->phone_number }}</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Birth Date: {{ $user->birth_date }}</h1>
        </div>
    </div>

</x-layout>