<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="flex flex-row w-screen h-screen">
        <div>
            <x-sidebar.sidebar />
        </div>
        
        <section id="main-content" class="bg-gray-100 w-full overflow-auto">
            <div class="border-b h-[4rem] flex justify-between px-6 items-center">
                <div class="text-sm font-medium">
                    {{ $pageName }}
                </div>
                @yield('header')
            </div>
            <div class="mt-10 px-4 sm:px-6 md:px-8">
                <div class="mb-10">
                    <span class="font-bold text-2xl md:text-3xl tracking-tight">{{ $pageName }}</span>
                </div>
                @yield('content')
            </div>
        </section>


    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap');

        @media only screen and (max-width: 1100px) {
            #sidebar {
                position: absolute;
                left: -320px;
            }
        }
    </style>
</body>
</html>