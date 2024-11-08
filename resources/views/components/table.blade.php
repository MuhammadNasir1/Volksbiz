<div class="overflow-auto">
    <table id="datatable" class="dataTable">
        <thead class="w-full font-semibold text-white bg-primary ">
            <tr class="w-full border-b whitespace-nowrap">
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="border-b border-gray-500" id="tableBody">
            {{ $tablebody }}
        </tbody>
    </table>

</div>
