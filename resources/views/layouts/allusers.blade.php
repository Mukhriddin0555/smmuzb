<div class="mb-4">
    <div>
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            Дўкондан чегирма олган харидорлар рўйхати<br>
        </h2><br>
    </div>
   <div class="flex justify-center">
        <table class="bg-white shadow-lg sm:rounded-lg">
            <th class="p-4 pr-7">№</th>
            <th class="p-4 pr-7">Фамилия</th>
            <th class="p-4 pr-7">Имя</th>
            <th class="p-4 pr-7">Номер телефона</th>
            <th class="p-4 pr-7">Номер для скидки</th>
            <th class="p-4 pr-7">Общая сумма</th>
            @php
                $number = 0;
            @endphp
            @foreach ($allusers as $user)
            @if ($user->saleproducts_sum_price_amount == null)
                @continue
            @endif
            <tr>
                <td class="p-4 pr-7">
                    @php
                        $number += 1;
                    @endphp
                    {{$number}}
                </td>
                <td class="p-4 pr-7">
                    {{$user->original_first_name}}
                </td>
                <td class="p-4 pr-7">
                    {{$user->original_last_name}}
                </td>
                <td class="p-4 pr-7">
                    {{$user->number2}}
                </td>
                <td class="p-4 pr-7">
                    {{$user->discount_number}}
                </td>
                <td class="p-4 pr-7">
                    {{$user->saleproducts_sum_price_amount}} сум
                </td>
            </tr>
            @endforeach
           </table>
    </div>
    
</div>
