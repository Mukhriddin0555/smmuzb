<div class="header-content flex justify-center flex-row">
    <form class="m-4 flex" action="{{ route('passpost')}}" method="post">
        @csrf
        <input class="rounded-l-lg p-4 border mr-0 text-gray-800 border-gray-200 bg-white" name="password" type="password" placeholder="Махфий код"/>
        <input type="hidden" name="sales_id" value="{{$verify->id}}">
        <button class="px-8 rounded bg-yellow-400  text-gray-800 font-bold p-4 border-yellow-500 border">Топиш</button>
    </form>
</div>