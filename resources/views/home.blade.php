<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Homepage') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="flex justify-center max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome to Guitart Scooter Shop! Here you will find an extended list of variated scooter products and components. Add anything you desire into your cart!") }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-5 gap-4  mb-12 mx-4 p-12 bg-gray-100 rounded-lg">
            @foreach($productes as $producte)
            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between relative">
                <div>
                    <img src="{{ asset('images/' . $producte->id . '.jpg') }}" alt="{{ $producte->nom }}" class="w-full h-32 object-contain mb-4 rounded-md">
                    <h3 class="text-lg font-semibold">{{ $producte->nom }}</h3>
                    
                </div>
                <div class="flex items-center justify-between mt-4">
                    <p class="text-lg font-bold text-gray-800">{{ $producte->preu }} €</p>
                    @auth
                    <a href="{{ route('cart.add', $producte->id) }}"
                        class=" bg-gray-500 text-white px-1.5 py-1 rounded hover:bg-gray-400">
                        {{ __('Add') }}
                    </a>
                    @endauth
                    <a href="{{ route('producte.show', $producte->id) }}" class="bg-gray-500 text-white px-1.5 py-1 rounded hover:bg-gray-400">
                        {{ __('See more') }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
