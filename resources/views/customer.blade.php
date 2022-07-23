<x-app-layout>
    <x-slot name="header">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="flex justify-center"">
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded flex justify-center">
            <strong class="font-bold">Хатолик: </strong>
            <span class="block sm:inline">{{ $error }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            </span>
          </div>
        </div>
        @endforeach
        @endif
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Сотувчи Кабинети') }} @if (!isset($user))
            <div class="header-content flex justify-center flex-row">
                <form class="m-4 flex" action="{{ route('userfind')}}" method="get">
                    <input class="rounded-l-lg p-4 border mr-0 text-gray-800 border-gray-200 bg-white" name="discount" placeholder="Discount_number"/>
                    <button class="px-8 rounded bg-yellow-400  text-gray-800 font-bold p-4 border-yellow-500 border">Топиш</button>
                </form>
            </div>
            @endif
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('sucsessed'))
                <div class="flex justify-center">
                    <div class="w-1/2 font-black bg-green-400 rounded m-5 text-center">{{ session('sucsessed') }}
                    </div>
                </div>
                @endif
                @if (session('badpassword'))
                <div class="flex justify-center">
                    <div class="w-1/2 font-black bg-red-200 rounded m-5 text-center">{{ session('badpassword') }}
                    </div>
                </div>
                @endif
                @if (session('danger'))
                <div class="flex justify-center">
                    <div class="w-1/2 font-black bg-red-200 rounded m-5 text-center">{{ session('danger') }}
                    </div>
                </div>
                @endif
                @if (isset($user))
                @include('layouts.table')
                @endif
                @if (isset($allusers))
                @include('layouts.allusers')
                @endif
                @if (isset($salesmans))
                @include('layouts.salesmans')
                @endif
                @if (isset($verify))
                @include('layouts.verify')
                @endif
            </div>
        </div>
        
    </div>
</x-app-layout>