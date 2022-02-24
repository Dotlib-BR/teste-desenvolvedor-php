<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageName }} - Meu Sistema</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>
<body>
    @include('sweetalert::alert')
    <div class="flex flex-row w-screen h-screen">
        <div class="hidden md:block">
            <x-sidebar.sidebar />
        </div>
        
        <section id="main-content" class="bg-gray-100 w-full overflow-auto">
            <div class="border-b h-[4rem] flex justify-between px-4 sm:px-6 md:px-20 items-center">
                <div class="text-sm font-medium space-x-3">
                    <span>
                        {{ $pageName  }}
                    </span>
                    @isset($pageDetail)
                        <span class="text-gray-600">{{ $pageDetail }}</span>
                    @endisset
                </div>
                @yield('header')
            </div>
            <div class="mt-10 px-4 sm:px-6 md:px-8 md:mx-14 mb-10">
                <div class="flex justify-between">
                    <div class="mb-10 font-bold text-2xl md:text-3xl tracking-tight space-x-4">
                        @isset($pageDetail)    
                            <span class="text-gray-700 text-xl md:text-2xl">{{ $pageDetail }}</span>
                        @endisset
                        <span>{{ $pageName }}</span>
                    </div>

                    <div class="font-medium tracking-tight">
                        @yield('buttons')
                    </div>
                </div>
                @yield('content')
            </div>
        </section>


    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap');
    </style>
    @livewireScripts
</body>
</html>