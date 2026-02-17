<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Países</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                {{ $message ?? 'Países cargados correctamente' }}
            </h1>
            <p class="text-xl text-gray-600">
                Total: <span class="font-semibold text-blue-600">{{ $total ?? 0 }}</span> países
            </p>
            @if(isset($continent))
                <div class="mt-2 bg-blue-100 border border-blue-300 text-blue-800 px-4 py-2 rounded-lg inline-block">
                    Filtrado por continente: <strong>{{ ucfirst($continent) }}</strong>
                </div>
            @endif
        </div>

        {{-- Errores --}}
        @if(isset($error))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-8">
                <strong>¡Error!</strong> {{ $error }}
                @if(isset($status))
                    <br>Código: {{ $status }}
                @endif
            </div>
        @endif

        {{-- Tabla de países --}}
        @if(empty($countries ?? []))
            <div class="text-center py-12">
                <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron países</h3>
                <p class="text-gray-500 mb-4">Intenta sin filtro o recarga la página.</p>
                <a href="{{ route('countries.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                    Ver todos los países
                </a>
            </div>
        @else
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Slug</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Continente</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($countries as $country)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $country['id'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ $country['name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $country['slug'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="/countries?continent={{ $country['continent'] }}" class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gradient-to-r
                                            @if(strtolower($country['continent']) === 'south america') from-red-100 to-orange-100 text-red-800
                                            @elseif(strtolower($country['continent']) === 'europe') from-blue-100 to-indigo-100 text-blue-800
                                            @elseif(strtolower($country['continent']) === 'asia') from-green-100 to-emerald-100 text-green-800
                                            @else from-purple-100 to-pink-100 text-purple-800 @endif">
                                            {{ $country['continent'] }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Botones de navegación --}}
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('countries.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Ver todos
                </a>
                <div class="text-sm text-gray-500">
                    Mostrando {{ $total }} países
                </div>
            </div>
        @endif
    </div>
</body>
</html>
