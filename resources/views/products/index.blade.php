<x-layout>
<h1 class="text-3xl font-bold mb-8">Products</h1>
<div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
    @foreach($products as $product)
    <div class="bg-white shadow-lg overflow-hidden">
        <div class="w-full h-52 bg-gray-300">
            @if($product->image)
            <img
                src="/storage/{{$product->image}}"
                alt="{{$product->image}}"
                class="h-full w-full object-cover"
            />
            @endif
        </div>
        <div class="p-4">
            <a href="{{ route('products.show', $product->id) }}" 
               class="text-xl font-semibold mb-2 block hover:text-blue-600 transition-colors duration-300">
               {{ $product->name }}
            </a>
            <p class="text-gray-600 mb-4">{{ $product->description }}</p>
            <div class="flex justify-between items-center">
                <span class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                <form action="{{ route('cart.add', $product->id) }}" method="GET">
                    @csrf
                    <button onclick='addToCart(@json($product))' 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors duration-300">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
</x-layout>