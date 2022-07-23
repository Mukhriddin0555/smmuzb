<div>
    <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
        Дўкон сотувчиси бўлган {{$verify->first_name}} {{$verify->last_name}} нинг <br>жамғармасини 0 га кайтариш учун махфий кодни киритинг!
        <br>
    </h2><br>
</div>
<div class="header-content flex justify-center flex-row">
    <form class="m-4 flex" action="{{ route('passpost')}}" method="post">
        @csrf
        <input class="rounded mr-4 p-4 border mr-0 text-gray-800 border-gray-200 bg-white" name="password" type="password" placeholder="Махфий код"/>
        <input type="hidden" name="sales_id" value="{{$verify->id}}">
        <button class="px-8 rounded bg-green-400  text-gray-800 font-bold p-4 border-gray-500 border">Юбориш</button>
    </form>
</div>