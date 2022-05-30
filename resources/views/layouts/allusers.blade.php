<div>
   <div class="flex justify-center">
        <table>
            <th class="p-4 pr-7">№</th>
            <th class="p-4 pr-7">Фамилия</th>
            <th class="p-4 pr-7">Имя</th>
            <th class="p-4 pr-7">Номер телефона</th>
            <th class="p-4 pr-7">Номер для скидки</th>
            <th class="p-4 pr-7">Общая сумма</th>
            @foreach ($allusers as $user)
            @if ($user->saleproducts_sum_price_amount == null)
                @continue
            @endif
            <tr>
                <td class="p-4 pr-7">
                    {{$loop->iteration}}
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
