<x-layout>

<x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
<x-slot:userID>{{ $id }}</x-slot:userID>
<x-slot:bgColor>{{ 'bg-orange-950' }}</x-slot:bgColor>

<div class="mb-20"></div>

<div class="p-4">

    <h1 class="text-7xl font-bold text-orange-300 text-center">User</h1>
    <div class="mb-16"></div>

    <table class="min w-full border-collapse bg-orange-100 rounded-lg shadow-md">
        <thead class="bg-orange-900 text-orange-200 rounded-lg">
            <tr>
                <th class="p-2 border-collapse border-2">No</th>
                <th class="p-2 border-collapse border-2">Username</th>
                <th class="p-2 border-collapse border-2">password</th>
                <th class="p-2 border-collapse border-2">name</th>
                <th class="p-2 border-collapse border-2">phone_number</th>
                <th class="p-2 border-collapse border-2">address</th>
                <th class="p-2 border-collapse border-2">birth date</th>
                <th class="p-2 border-collapse border-2">image profile</th>
                <th class="p-2 border-collapse border-2">class id</th>
                {{-- <th class="p-2 border-collapse border-2"></th> --}}
            </tr>
        </thead>

        @foreach ($users as $pro)
        <tr>
            <td class="p-2 border-collapse border-2">{{ $pro->id }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->username }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->password }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->name }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->phone_number }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->address }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->birth_date }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->image_profile }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->class_id }}</td>
        </tr>
        {{-- <td class="p-2 border-collapse border-2">{{ $pro }}</td> --}}
        @endforeach

    </table>

    <h1 class="text-7xl font-bold text-orange-300 text-center">Payment</h1>
    <div class="mb-16"></div>

    <table class="min w-full border-collapse bg-orange-100 rounded-lg shadow-md">
        <thead class="bg-orange-900 text-orange-200 rounded-lg">
            <tr>
                <th class="p-2 border-collapse border-2">No</th>
                <th class="p-2 border-collapse border-2">User_id</th>
                <th class="p-2 border-collapse border-2">Month Paid</th>
                <th class="p-2 border-collapse border-2">Payment Date</th>
                <th class="p-2 border-collapse border-2">Status</th>
                <th class="p-2 border-collapse border-2">Amount</th>
            </tr>
        </thead>

        @foreach ($payments as $pro)
        <tr>
            <td class="p-2 border-collapse border-2">{{ $pro->id }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->user_id }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->month_paid }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->payment_date }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->status }}</td>
            <td class="p-2 border-collapse border-2">{{ $pro->amount }}</td>
        </tr>
        {{-- <td class="p-2 border-collapse border-2">{{ $pro }}</td> --}}
        @endforeach

    </table>

    

</div>

</x-layout>