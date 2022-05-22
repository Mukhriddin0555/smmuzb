<div>
    <div>
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            Харидор: {{$user->original_last_name}} {{$user->original_first_name}} <br>
        </h2><br>
    </div>
    <div>
        <form class="w-full" action="{{ route('addsales', [$user->id])}}" method="post">
            @csrf
            <div class="flex justify-center font-bold">Савдо хакида малумот кушиш</div>
            <br>
            <div class="flex justify-center m-3 ml-8 mb-6">
                <input class="rounded-l-lg p-4 border mr-0 text-gray-800 border-gray-200 bg-white" name="amount" type="number" placeholder="Савдо суммаси"/>
                <button class="px-8 rounded bg-yellow-400  text-gray-800 font-bold p-4 border-yellow-500 border">Кушиш</button>
            </div>
            
          </form>
    </div>
    @if (isset($user->saleproducts[0]))
    <div class="flex justify-center">
        <table>
            <th class="p-4 pr-7">№</th>
            <th class="p-4 pr-7">Дата</th>
            <th class="p-4 pr-7">Сумма</th>
            <th class="p-4 pr-7">%</th>
            <th class="p-4 pr-7">Сумма скидки</th>
            <th class="p-4 pr-7">Оплачен</th>
            <th class="p-4 pr-7"></th>
            @php
                $discount = 0;
                $paid = 0;
            @endphp
            @foreach ($user->saleproducts as $item)
            @if ($item->customer_id != $customer)
                @continue
            @endif
            <tr>
                <td class="p-4 pr-7">
                    {{$loop->iteration}}
                </td>
                <td class="p-4 pr-7">
                    {{$item->created_at}}
                </td>
                <td class="p-4 pr-7">
                    {{$item->price_amount}} сум
                </td>
                <td class="p-4 pr-7">
                    {{$item->discount}} %
                </td>
                <td class="p-4 pr-7">
                    {{($item->price_amount / 100) * $item->discount}} сум
                    @php
                        $discount = $discount + (($item->price_amount / 100) * $item->discount);
                    @endphp
                </td>
                <td>
                    <div class="p-4 pr-7 bg-sky-500 rounded">
                        {{$item->price_amount - (($item->price_amount / 100) * $item->discount)}} сум
                    </div>
                    @php
                        $paid = $paid + ($item->price_amount - (($item->price_amount / 100) * $item->discount));
                    @endphp
                </td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td class="p-4 pr-7">{{ $sum }}</td>
                <td></td>
                <td class="p-4 pr-7">{{ $discount }}</td>
                <td class="p-4 pr-7 bg-sky-500 rounded">{{ $paid }}</td>
            </tr>
            
            
        </table>
        
        @else
            <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
                Харидор скидка олмаган
            </h2>
            @endif
    </div>
    
</div>
