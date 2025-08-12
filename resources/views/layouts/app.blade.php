<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestor Organizacional</title>

    {{-- Importa o CSS gerado pelo Vite --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <header class="bg-blue-700 text-white p-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-lg font-bold">Gestor Organizacional</a>
            <nav class="space-x-4">
                <a href="{{ route('tasks.index') }}" class="hover:underline">Tarefas</a>
                <a href="{{ route('meetings.index') }}" class="hover:underline">Reuniões</a>
                {{-- Outras rotas --}}
            </nav>
        </div>
    </header>

    <main class="container mx-auto flex-grow p-6">
        @yield('content')
    </main>

    <footer class="bg-gray-200 text-center p-4 text-sm text-gray-600">
        &copy; {{ date('Y') }} Gestor Organizacional - Todos os direitos reservados.
    </footer>

</body>
</html>
