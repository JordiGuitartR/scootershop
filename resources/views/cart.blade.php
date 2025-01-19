<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mb-20 mx-auto sm:px-6 lg:px-8">
            @if ($productes && $productes->count())
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('Product') }}</th>
                                <th class="text-left">{{ __('Name') }}</th>
                                <th class="text-left">{{ __('Price') }}</th>
                                <th class="text-left">{{ __('Quantity') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productes as $producte)
                                <tr>
                                    <td><img src="{{ asset('images/' . $producte->producte->id . '.jpg') }}" class="w-12 h-12 object-contain"></td>
                                    <td>{{ $producte->producte->nom }}</td>
                                    <td>{{ $producte->preu_unitari }} €</td>
                                    <td class="flex items-center space-x-4">
                                        
                                        <form action="{{ route('cart.update', ['id' => $producte->producte_id, 'action' => 'decrement']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-gray-300 text-black px-1.5 py-0.25 mt-2 rounded hover:bg-gray-400">
                                                -
                                            </button>
                                        </form>
                                    
                                        <span class="mt-3">{{ $producte->quantitat }}</span>
                                    
                                        <form action="{{ route('cart.update', ['id' => $producte->producte_id, 'action' => 'increment']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-gray-300 text-black px-1.5 py-0.25 mt-2 rounded hover:bg-gray-400">
                                                +
                                            </button>
                                        </form>
                                    </td>
                                    
                                    <td>
                                        <a href="{{ route('cart.remove', $producte->producte_id) }}" class="text-red-500">
                                            🗑
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{-- <p class="text-lg font-bold">{{ __('Order Status:') }} {{ $comanda->estat }}</p> --}}
                        <p class="text-lg font-bold">{{ __('Total:') }} {{ $comanda->total }} €</p>
                    </div>
                </div>
            @else
            <div class="bg-red-100 text-red-800 p-6 rounded-lg shadow-md ">
                {{ __('Your cart is empty.') }}
            </div>
            @endif
        </div>
    </div>
</x-guest-layout>
