<x-layout>

    <x-slot:headerTitle>{{$pagetitle}}</x-slot:headerTitle>
    <x-slot:userID>{{ (int) request() }}</x-slot:userID>
    <x-slot:bgColor>{{ 'bg-orange-950' }}</x-slot:bgColor>
    
    <div class="mb-20"></div>

    <div class="p-4">
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

            @php
                $test = [
                    ['January', '16 jan 2013', 'Paid', 'Rp.123.000'],
                    ['January', '15 jan 2013', 'Paid', 'Rp.122.000'],
                    ['January', '14 jan 2013', 'Not Paid Yet', 'Rp.121.000'],
                    ['January', '13 jan 2013', 'Paid', 'Rp.120.000'],
                    ['January', '12 jan 2013', 'Paid', 'Rp.119.000'],
                ];
            @endphp

            @foreach ($test as $pro)
            <tr>
                <td class="p-2 border-collapse border-2">{{ $loop->index + 1 }}</td>
                <td class="p-2 border-collapse border-2">{{ $pro[0] }}</td>
                <td class="p-2 border-collapse border-2">{{ $pro[1] }}</td>
                <td class="p-2 border-collapse border-2">{{ $pro[2] }}</td>
                <td class="p-2 border-collapse border-2">{{ $pro[3] }}</td>
            </tr>
            @endforeach

        </table>

        

    </div>

</x-layout>