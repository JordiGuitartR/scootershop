<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Producte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white p-10 rounded-lg shadow-md flex items-start space-x-6 mb-12 mx-20">
            @if ($producte)
                <!-- Imatge del producte -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('images/' . $producte->id . '.jpg') }}" alt="{{ $producte->nom }}"
                        class="w-64 h-64 object-contain rounded-md">
                </div>

                <!-- Informació del producte -->
                <div>
                    <h3 class="text-2xl font-bold mb-4">{{ $producte->nom }}</h3>
                    <p class="text-gray-700 mb-4">{{ $producte->descripcio }}</p>
                    <p class="text-lg font-bold mb-4">{{ __('Preu:') }} {{ $producte->preu }} €</p>
                    <p class="text-gray-600">{{ __('Categoria:') }}
                        {{ $producte->categoria ? $producte->categoria->nom_categoria : __('Sense categoria') }}</p>

                    <a href="{{ route('cart.add', $producte->id) }}"
                        class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        {{ __('Add to cart') }}
                    </a>

                </div>
            @else
                <div class="bg-red-100 text-red-800 p-6 rounded-lg shadow-md">
                    {{ __('No s’ha seleccionat cap producte.') }}
                </div>
            @endif
        </div>

    </div>
</x-guest-layout>
