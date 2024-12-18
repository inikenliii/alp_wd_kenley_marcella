<x-layout>

    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    <x-slot:bgColor>{{ 'bg-amber-950' }}</x-slot:bgColor>

    <div class="mb-20"></div>

    <div class="flex p-8">
        <div class="flex-1">
            <img class="size-full rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </div>

        <div class="flex-2 mr-24"></div>
        
        <div class="flex-1">
            <h1 class="text-orange-200 text-7xl font-bold">Name</h1>
            <div class="flex-2 mb-8"></div>

            <h1 class="text-orange-200 text-3xl font-medium">Username: $Username</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Address: 123 st AAA</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Phone Number: +1235667</h1>
            <h1 class="text-orange-200 text-3xl font-medium">Birth Date: 12 Jan 2012</h1>
        </div>
    </div>

</x-layout>