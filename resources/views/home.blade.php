<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Homepage') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome to Guitart Scooter Shop! Here you will find an extended list of different scooter products and components. Add anything you desire into your cart!") }}
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-5 gap-4  mb-12 mx-4 p-12 bg-gray-100 rounded-lg">
            @foreach($productes as $producte)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <img src="{{ asset('images/' . $producte->id . '.jpg') }}" alt="{{ $producte->nom }}" class="w-full h-32 object-contain mb-4 rounded-md">
                    <h3 class="text-lg font-semibold">{{ $producte->nom }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $producte->descripcio }}</p>
                    <p class="text-lg font-bold text-gray-800">{{ $producte->preu }} €</p>
                    <a href="{{ route('producte.show', $producte->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        {{ __('Ver más') }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
