<x-layout>

    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    <x-slot:userID>{{ $id }}</x-slot:userID>
    <x-slot:bgColor>{{ 'bg-orange-950' }}</x-slot:bgColor>
    
    <div class="mb-20"></div>

    <div class="p-4">

        @if ($payment)
            <h1 class="text-7xl font-bold text-orange-300 text-center">Payment</h1>
            <div class="mb-16"></div>

            <table class="min w-full border-collapse bg-orange-100 rounded-lg shadow-md">
            <thead class="bg-orange-900 text-orange-200 rounded-lg">
                <tr>
                    <th class="p-2 border-collapse border-2">No</th>
                    <th class="p-2 border-collapse border-2">Month Paid</th>
                    <th class="p-2 border-collapse border-2">Payment Date</th>
                    <th class="p-2 border-collapse border-2">Status</th>
                    <th class="p-2 border-collapse border-2">Amount</th>
                </tr>
            </thead>

            @foreach ($payment as $pro)
                <tr>
                    <td class="p-2 border-collapse border-2">{{ $loop->index + 1 }}</td>
                    <td class="p-2 border-collapse border-2">{{ $pro->month_paid }}</td>
                    <td class="p-2 border-collapse border-2">{{ $pro->payment_date }}</td>
                    <td class="p-2 border-collapse border-2">{{ $pro->status }}</td>
                    <td class="p-2 border-collapse border-2">{{ $pro->amount }}</td>
                </tr>
            @endforeach
        @else
            <h1 class="text-7xl font-bold text-orange-300 text-center">No Payment Record yet</h1>
        @endif

        </table>

        

    </div>

</x-layout>