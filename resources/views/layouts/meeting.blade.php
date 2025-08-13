<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Organiza Ai - Reuniões</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<header class="bg-blue-700 text-white p-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-lg font-bold">Organiza Ai</a>
        <nav class="space-x-4">
            <a href="{{ route('tasks.index') }}" class="hover:underline">Tarefas</a>
            <a href="{{ route('meetings.index') }}" class="hover:underline">Reuniões</a>
        </nav>
    </div>
</header>

<main class="container mx-auto flex-grow p-6">
    @yield('content')
</main>

</body>
</html>
