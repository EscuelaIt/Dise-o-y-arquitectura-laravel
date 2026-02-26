@extends('layouts.app')

@section('content')
@if(session('error'))
    <div id="error-alert" class="w-full lg:max-w-4xl max-w-[335px] mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3 animate-in fade-in slide-in-from-top-2 duration-300">
        <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="flex-1">
            <p class="text-sm font-medium text-red-800 dark:text-red-300">
                {{ session('error') }}
            </p>
        </div>
        <button onclick="document.getElementById('error-alert').remove()" class="flex-shrink-0 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
@endif
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-bold mb-4">Planes de Suscripción</h1>
        <p class="text-gray-600">Selecciona un plan para suscribirte.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($plans as $plan)
            <!-- Plan -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow @if($loop->index === 1) border-2 border-blue-600 @endif">
                <div class="p-6">
                    @if($loop->index === 1)
                        <div class="inline-block bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full mb-4">
                            POPULAR
                        </div>
                    @endif
                    <h5 class="text-xl font-bold mb-2">{{ $plan->name }}</h5>
                    <p class="text-gray-600 mb-4">{{ $plan->description }}</p>
                    <p class="text-3xl font-bold text-blue-600 mb-6">${{ number_format($plan->price, 2) }}/mes</p>
                    <form action="{{ route('subscription.subscribe', $plan) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                            Suscribirse
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-600">No hay planes disponibles</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
