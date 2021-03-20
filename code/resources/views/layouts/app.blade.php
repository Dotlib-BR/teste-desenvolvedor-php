<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icons.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        {{-- Data Table Scripts --}}
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>        
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-wrap flex-row justify-between">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
            $(document).ready(function() {
                var table = $('#table').DataTable({
                    responsive: true,
                    "language": { "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json" }
                })
                .columns.adjust()
                .responsive.recalc();
            });
            const checkbox = document.getElementsByClassName("checkbox")
        const form = document.getElementById("destroy-form-mult")
        const button = document.getElementById("button-mult")

        const countElements = () => form.childElementCount

        const generateInput = (value) => {
            const input = document.createElement("input")
            input.type = "hidden"
            input.value = value
            input.name = "clients_id[]"
            input.id = "client-" + value

            return input
        }

        const insertId = (id) => {
          const input = generateInput(id)
          form.appendChild(input)
          if(countElements() > 2) button.disabled = false
        }

        const removeId = (id) => {
          const element = document.getElementById("client-" + id)
          form.removeChild(element)
          if(countElements() == 2) button.disabled = true
        }

        const handleChange = (event) => {
          const element = event.target

          if(element.checked) insertId(element.value)
          else removeId(element.value)
        }

        Array.from(checkbox).forEach(element => {
          element.addEventListener("change", handleChange)
        })
        </script>
        {{ $scripts ?? '' }}
    </body>
</html>
