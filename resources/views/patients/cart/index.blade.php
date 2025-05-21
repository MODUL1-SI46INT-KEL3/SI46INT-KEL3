@include('navigation.navbar')
<body class="bg-white text-gray-800">

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold border-b pb-2 mb-4">List of Items</h2>

    <div class="flex flex-wrap md:flex-nowrap">
        <!-- Left: Cart List -->
        <div class="w-full md:w-2/3">
            @foreach ($cartItems as $item)
                <div class="flex items-center justify-between border-b py-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-6 h-6 rounded-full bg-{{ $item->selected ? 'red-600' : 'gray-400' }}"></div>
                        <div>
                            <p class="font-semibold">{{ $item->medicine->name }}</p>
                            <small class="text-gray-500">Per Strip</small>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <form method="POST" action="{{ route('cart.decrease', $item->id) }}">
                            @csrf
                            <button class="text-red-600 font-bold">➖</button>
                        </form>
                        <span>{{ $item->quantity }}</span>
                        <form method="POST" action="{{ route('cart.increase', $item->id) }}">
                            @csrf
                            <button class="text-red-600 font-bold">➕</button>
                        </form>
                    </div>

                    <div class="text-right">
                        Rp{{ number_format($item->medicine->price, 3, ',', '.') }}
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                <a href="{{ route('medicines.index') }}" class="inline-flex items-center px-4 py-2 bg-red-700 text-white rounded shadow">
                    🛒 Add More
                </a>
            </div>
        </div>

        <!-- Right: Summary Panel -->
        <div class="w-full md:w-1/3 md:pl-8 mt-6 md:mt-0">
            <img src="{{ asset('images/pills.jpg') }}" alt="Pills" class="rounded mb-4">
            <div class="text-sm text-gray-700">
                <p class="font-bold mb-2">Your item total..</p>
                <p><strong>For {{ $cartItems->sum('quantity') }} Items</strong></p>
                <p class="text-lg font-bold">
                    Rp{{ number_format($cartItems->sum(fn($item) => $item->medicine->price * $item->quantity), 3, ',', '.') }}
                </p>
            </div>

            <form action="{{ route('checkout') }}" method="POST" class="mt-4">
                @csrf
                <button class="w-full bg-red-700 text-white py-2 rounded shadow">
                    Continue to Pay
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
