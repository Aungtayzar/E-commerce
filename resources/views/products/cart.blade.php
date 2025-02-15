<x-layout>
    <table class="w-full border-collapse border border-gray-300 shadow-lg rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                <th class="px-4 py-2 border">Product Name</th>
                <th class="px-4 py-2 border">Quantity</th>
                <th class="px-4 py-2 border">Price</th>
                <th class="px-4 py-2 border">Subtotal</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if(count((array) session('cart')) == 0)
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No items in cart</td>
                </tr>
            @else
                @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr data-id="{{ $id }}" class="border-t hover:bg-gray-50">
                        <td data-th="Product" class="px-4 py-2 border">{{ $details['name'] }}</td>
                        <td data-th="Quantity" class="px-4 py-2 border text-center">{{ $details['quantity'] }}</td>
                        <td data-th="Price" class="px-4 py-2 border text-center">${{ number_format($details['price'], 2) }}</td>
                        <td data-th="Subtotal" class="px-4 py-2 border text-center">
                            ${{ number_format($details['quantity'] * $details['price'], 2) }}
                        </td>
                        <td data-th="" class="px-4 py-2 border text-center">
                            <button class="cart_remove bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    


    <!-- Total Price & Checkout -->
<div class="flex justify-end items-center mt-6">
        <h3 class="text-xl font-semibold text-gray-700">Total: ${{ number_format($total, 2) }}</h3>

    @if($total > 0)
        <form action="" method="POST" class="ml-6"> 
            @csrf
            <button type="button" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition">
                Checkout
            </button>
        </form>
    @endif
</div>

<div class="flex justify-start items-center mt-6">
    <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition mt-6">
        Continue Shopping
    </a>
</div>

<script>
    $(document).ready(function(){
        $(".cart_remove").click(function(e){
            e.preventDefault();

            var ele = $(this);

            if(confirm("Do you reallwy want to remove?")){
                $.ajax({
                    url:'{{route('remove_from_cart')}}',
                    method:"DELETE",    
                    data:{
                        _token:'{{csrf_token()}}',
                        id:ele.parents("tr").attr("data-id")
                    },
                    success:function(response){
                        // console.log(response);
                        window.location.reload();
                    }
                });
            }
        })
    });

</script>

    
</x-layout>