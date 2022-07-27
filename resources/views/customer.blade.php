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
        <h2 class="font-semibold text-xl text-gray-800 text-right leading-tight">
            {{ __('Сотувчи Кабинети') }} 
            @if (!isset($user) && !isset($verify))
            <div class="header-content flex justify-center flex-row">
                <form class="flex" action="{{ route('userfind')}}" method="get">
                    <input class="rounded mr-4 p-3 border text-gray-800 border-gray-200 bg-white" name="discount" placeholder="Discount_number"/>
                    <button class="px-8 rounded bg-yellow-400  hover:bg-yellow-300 text-gray-800 font-bold p-3 border-yellow-500 border">Топиш</button>
                </form>
            </div>
            @endif
        </h2>
        
    </x-slot>

    <div>
        <div>
            <div class="bg-white overflow-hidden sm:rounded-lg">
                @if (session('sucsessed'))
                <div class="flex mb-3 justify-center">
                    <div class="w-1/2 mb-3 font-black bg-green-400 rounded m-5 text-center">{{ session('sucsessed') }}
                    </div>
                </div>
                @endif
                @if (session('badpassword'))
                <div class="flex mb-3 justify-center">
                    <div class="w-1/2 font-black bg-red-200 rounded m-5 text-center">{{ session('badpassword') }}
                    </div>
                </div>
                @endif
                @if (session('danger'))
                <div class="flex mb-3 justify-center">
                    <div class="w-1/2 font-black mb-3 bg-red-200 rounded m-5 text-center">{{ session('danger') }}
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