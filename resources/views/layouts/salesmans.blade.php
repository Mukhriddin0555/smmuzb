<div class="flex justify-center">
    <table>
        <th class="p-4 pr-7">№</th>
        <th class="p-4 pr-7">Исм</th>
        <th class="p-4 pr-7">Фамилия</th>
        <th class="p-4 pr-7">сумма</th>
        <th class="p-4 pr-7"></th>
        @foreach ($salesmans as $sales)
        <tr>
            <td class="p-4 pr-7">
                {{$loop->iteration}}
            </td>
            <td class="p-4 pr-7">
                {{$sales->first_name}}
            </td>
            <td class="p-4 pr-7">
                {{$sales->last_name}}
            </td>
            <td class="p-4 pr-7">
                {{$sales->sales}} сумм
            </td>
            <td class="p-4 pr-7">
                <a href="{{route('pass', $sales->id )}}">Топшириш</a>
            </td>
        </tr>
        @endforeach
    </table>