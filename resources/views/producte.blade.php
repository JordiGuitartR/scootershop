<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
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
                    <!-- Formulario para editar el producto, visible solo para admin -->
                    @if (auth()->check() && auth()->user()->admin)
                        <form action="{{ route('productes.update', $producte->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nombre del producto: Editable si es admin -->
                            <input type="text" name="nom" value="{{ old('nom', $producte->nom) }}" class="text-2xl font-bold mb-4">

                            <!-- Descripción del producto: Editable si es admin -->
                            <textarea name="descripcio" class="w-full mb-4">{{ old('descripcio', $producte->descripcio) }}</textarea>

                            <!-- Precio del producto: Editable si es admin -->
                            <input type="number" name="preu" value="{{ old('preu', $producte->preu) }}" class="w-full mb-4">

                            <!-- Botón para guardar los cambios -->
                            <button type="submit" class=" bg-gray-500 text-white px-4 py-2 rounded mt-4 mb-4 hover:bg-gray-400">
                                {{ __('Save') }}
                            </button>
                        </form>
                    @else
                        <!-- Si no es admin, mostrar solo los datos -->
                        <h3 class="text-2xl font-bold mb-4">{{ $producte->nom }}</h3>
                        <p class="text-gray-700 mb-4">{{ $producte->descripcio }}</p>
                        <p class="text-lg font-bold mb-4">{{ __('Price:') }} {{ $producte->preu }} €</p>
                    @endif

                    <!-- Categoria del producto -->
                    <p class="text-gray-600">{{ __('Category:') }}
                        {{ $producte->categoria ? $producte->categoria->nom_categoria : __('Sense categoria') }}</p>

                    @auth
                    <a href="{{ route('cart.add', $producte->id) }}"
                        class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">
                        {{ __('Add to cart') }}
                    </a>
                    @endauth
                </div>
            @else
                <div class="bg-red-100 text-red-800 p-6 rounded-lg shadow-md">
                    {{ __('No product has been selected.') }}
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
