   <!-- Navigation  -->
   <header class="bg-gray-800 text-white" x-data="{open:false}">
    <div class="mx-auto flex justify-between items-center p-3">
        <div class="text-2xl font-bold w-full md:w-auto md:text-left mb-2 md:mb-0"><a href="/">E-commerce</a></div>
        <nav class="hidden md:flex bg-gray-800 p-4 justify-between items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-4">
                        <a href="/" class="hover:text-gray-300 outline-none">Home</a>
                        <a href="/products" class="hover:text-gray-300 outline-none">Product List</a>
                        @auth
                            <button  class="hover:text-gray-300">
                                <a href="{{route('cart.index')}}">Cart</a> (<span id="cart-count">{{count((array) session('cart'))}}</span>)
                            </button>
                            @if(auth()->user()->role == 'admin')
                                <a href="{{url('products/create')}}" class="hover:text-gray-300">Create Products</a>
                            @endif
                            <form method="POST" action="{{route('logout')}}" class="inline">
                                @csrf
                                <button type="submit" class="hover:text-gray-300">Logout</button>
                            </form>
                        @else
                            <a href="{{url('/login')}}" class="hover:text-gray-300">Login</a>
                            <a href="{{url('/register')}}" class="hover:text-gray-300">Register</a>
                        @endauth
                    </div>
                </div>
            </div>        
        </nav>
        <button id="hamburger" @click="open = !open" class="text-white md:hidden flex items-center">
            <i class="fa fa-bars text-2xl"></i>
         </button>
    </div>
    <!-- Mobile Navigation  -->
    <div    x-show="open"
            @click.away="open = false"
            id="mobile-menu"
            class="md:hidden bg-gray-800 text-white mt-5 pb-4 space-y-2"
        >
            <a href="/" class="block px-4 py-2 hover:bg-gray-700">Home</a>
            <a href="/products" class="block px-4 py-2 hover:bg-gray-700">Product List</a>
            @auth
                <a href="{{route('cart.index')}}" class="block px-4 py-2 hover:bg-gray-700">Cart (<span id="cart-count">{{count((array) session('cart'))}}</span>)</a>
                @if(auth()->user()->role == 'admin')
                    <a href="{{url('products/create')}}" class="block px-4 py-2 hover:bg-gray-700">Create Products</a>
                @endif
                <form method="POST" action="{{route('logout')}}" class="block px-4 py-2">
                    @csrf
                    <button type="submit" class="w-full text-left hover:bg-gray-700">Logout</button>
                </form>
            @else
                <a href="{{url('/login')}}" class="block px-4 py-2 hover:bg-gray-700">Login</a>
                <a href="{{url('/register')}}" class="block px-4 py-2 hover:bg-gray-700">Register</a>
            @endauth
        </div>
</header>