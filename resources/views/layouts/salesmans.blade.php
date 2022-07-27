<div>
    <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
        Дўкон сотувчилари рўйхати<br>
    </h2><br>
</div>
<div class="flex justify-center">
    <table class="bg-white shadow-lg sm:rounded-lg mb-4">
        <th class="p-1 pr-7">№</th>
        <th class="p-1 pr-7">Исм</th>
        <th class="p-1 pr-7">Фамилия</th>
        <th class="p-1 pr-7">Телефон</th>
        <th class="p-1 pr-7">сумма</th>
        <th class="p-1 pr-7"></th>
        @foreach ($salesmans as $sales)
        <tr class="p-4">
            <td class="p-1 pr-7">
                {{$loop->iteration}}
            </td>
            <td class="p-1 pr-7">
                {{$sales->first_name}}
            </td>
            <td class="p-1 pr-7">
                {{$sales->last_name}}
            </td>
            <td class="p-1 pr-7">
                {{$sales->number}}
            </td>
            <td class="p-1 pr-7">
                {{$sales->sales}} сумм
            </td>
            <td class="p-4 pr-7 ">
                
                <a href="{{route('pass', $sales->id )}}" class=""><p class="bg-green-400 rounded p-2 text-inherit hover:bg-green-300">Топшириш</p></a>
            </td>
        </tr>
        @endforeach
    </table>