@extends('layouts.app')

@section('content')
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
