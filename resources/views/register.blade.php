<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Дукон номи</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased ">
        
      <section class="py-26 bg-white">
        <div class="container px-4 mx-auto mb-8">
          <div class="max-w-lg mx-auto">
            <div class="text-center mb-8">
              <a class="inline-block mx-auto mb-6" href="#">
                <img src="nigodo-assets/logo-icon-nigodo.svg" alt="">
              </a>
              <h2 class="text-3xl md:text-4xl font-extrabold mb-2">Дукон номи</h2>
                </div>
            <form action="{{ route('registered', random_int(100, 999) . $user->id . random_int(100, 999)) }}" method="POST">
              @csrf
              <div class="mb-6">
                <label class="block mb-2 font-extrabold" for="">Исм</label>
                <input class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded" name='last_name' type="text" placeholder="Исмингиз">
              </div>
              <div class="mb-6">
                <label class="block mb-2 font-extrabold" for="">Фамилия</label>
                <input class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded" name='first_name' type="text" placeholder="Фамилиянгиз">
              </div>
              <div class="mb-6">
                <label class="block mb-2 font-extrabold" for="">Телефон</label>
                <input class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded" name='number' type="text" placeholder="Кушимча телефон ракамингиз">
              </div>
              <button type='submit' class="inline-block w-full py-4 px-6 mb-6 text-center text-lg leading-6 text-white font-extrabold bg-indigo-800 hover:bg-indigo-900 border-3 border-indigo-900 shadow rounded transition duration-200">Юбориш</button>
              </form>
          </div>
        </div>
      </section>
        
    </body>
</html>