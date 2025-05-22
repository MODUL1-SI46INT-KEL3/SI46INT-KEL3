
<head>
    <style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #ffffff;
    color: #1f2937; /* text-gray-800 */
    margin: 0;
    padding: 0;
}

header {
    display: flex;
    background-image: linear-gradient(to right, #EB1F27 , #851216);
    margin-left: 100px;
    padding: 10px;
    padding-bottom: 20px;
    border-radius: 0 0 0 60px;
}
.logo {
    background-color: #fff;
    border-radius: 50%;
    height: 90px;
    width: 90px;
    margin-left: 50px;    
}
.logo img {
    float: left;
    height: 50px;
    margin-left: 15px;
    margin-right: auto;
    margin-top: 20px;
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}

h2 {
    font-size: 1.5rem;
    font-weight: bold;
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid #000;
}

.flex {
    display: flex;
    flex-wrap: wrap;
}

.md\:flex-nowrap {
    flex-wrap: nowrap;
}

.w-full {
    width: 100%;
}

.md\:w-2\/3 {
    width: 66.666667%;
}

.md\:w-1\/3 {
    width: 33.333333%;
}

.md\:pl-8 {
    padding-left: 2rem;
}

.md\:mt-0 {
    margin-top: 0;
}

.mt-6 {
    margin-top: 1.5rem;
}

.items-center {
    align-items: center;
}

.justify-between {
    justify-content: space-between;
}

.border-b {
    border-bottom: 1px solid #e5e7eb;
}

.py-4 {
    padding: 1rem 0;
}

.space-x-4 {
    column-gap: 1rem;
}

.space-x-2 {
    column-gap: 0.5rem;
}

.rounded {
    border-radius: 0.5rem;
}

.shadow {
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.text-sm {
    font-size: 0.875rem;
}

.text-lg {
    font-size: 1.125rem;
}

.text-gray-500 {
    color: #6b7280;
}

.text-gray-700 {
    color: #374151;
}

.text-red-600 {
    color: #dc2626;
}

.bg-red-600 {
    background-color: #dc2626;
}

.bg-red-700 {
    background-color: #b91c1c;
}

.bg-gray-400 {
    background-color: #9ca3af;
}

.font-semibold {
    font-weight: 600;
}

.font-bold {
    font-weight: 700;
}

button {
    background: none;
    border: none;
    cursor: pointer;
}

.inline-flex {
    display: inline-flex;
    align-items: center;
}

.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}

.py-2 {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.text-white {
    color: white;
}

/* Custom Styles for Checkmark + Image */

.checkmark-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    flex-shrink: 0;
}

.checkmark-icon img {
    width: 12px;
    height: 12px;
}

.medicine-image {
    width: 48px;
    height: 48px;
    border-radius: 0.25rem;
    object-fit: cover;
    margin-left: 0.5rem;
}

.items{
    display: grid;
    grid-template-columns: 1fr 95px 100px;
    align-items: center;
    gap: 1rem;
}


    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<div id="header">
    <header>
        <div class="logo">
            <a href="{{ route('patients.index') }}">
                <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika" />
            </a>
        </div>
    </header>
</div>
<body class="bg-white text-gray-800">

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold border-b pb-2 mb-4">List of Items</h2>

    <div class="flex flex-wrap md:flex-nowrap">
        <div class="w-full md:w-2/3">
            @foreach ($cartItems as $item)
                <div class="items" border-b py-4" style="height:80px;">
                    <div class="flex items-center space-x-4">
                            <div 
                                x-data="{
                                    selected: false,
                                    checkedIcon: '{{ asset('icons/checked.png') }}',
                                    uncheckedIcon: '{{ asset('icons/unchecked.png') }}'
                                }" 
                                @click="selected = !selected"
                                class="checkmark-icon cursor-pointer"
                                :class="selected ? 'bg-red-600' : 'bg-gray-400'"
                            >
                                <img :src="selected ? checkedIcon : uncheckedIcon" alt="Check" style="height:24px;width:24px;"/>
                            </div>


                            @if($item->medicine->image && file_exists(public_path($item->medicine->image)))
                                <img class="medicine-image" src="{{ asset($item->medicine->image) }}" alt="{{ $item->medicine->medicine_name }}" />
                            @else
                                <img class="medicine-image" src="{{ asset('images/medicines/default.png') }}" alt="No Image Available" />
                            @endif

                        <div>
                            <p class="font-semibold" style="margin:5px 0;">{{ $item->medicine->medicine_name }}</p>
                            <small class="text-gray-500" style="padding-bottom:20px;">Per Strip</small>
                        </div>
                    </div>

                    <div class="text-right">
                        Rp{{ number_format($item->medicine->price, 2, ',', '.') }}
                    </div>
                    
                    <div class="flex items-center space-x-2" style="border: 2px solid black; padding: 0.3rem 0.2rem; border-radius: 0.3rem; justify-content: center; align-items: center;">
                        <form method="POST" action="{{ route('cart.decrease', $item->id) }}" style="margin:2px 0;">
                            @csrf
                            <button class="text-red-600 font-bold">
                                <img src="{{ asset('icons/minus.png') }}" alt="Minus" style="width:16px;height:16px; vertical-align: middle; display: inline-block;" >

                            </button>
                        </form>
                        <span>{{ $item->quantity }}</span>
                        <form method="POST" action="{{ route('cart.increase', $item->id) }}" style="margin:2px 0;">
                            @csrf
                            <button class="text-red-600 font-bold">
                                <img src="{{ asset('icons/plus.png') }}" alt="Plus" style="width:16px;height:16px; vertical-align: middle; display: inline-block;" >
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach

            <div class="mt-6">
                <a href="{{ route('medicines.index') }}" class="inline-flex items-center px-4 py-2 bg-red-700 text-white rounded shadow" style="text-decoration: none;">
                    Add More
                </a>
            </div>
        </div>

        <!-- Right: Summary Panel -->
        <div class="w-full md:w-1/3 md:pl-8 mt-6 md:mt-0">
            <img src="{{ asset('icons/meds.png') }}" alt="Pills" class="rounded mb-4" style="width:100%;">
            <div class="text-sm text-gray-700">
                <div style="display: flex; justify-content: space-between; height: 30px;">
                    <p class="font-bold mb-2" >Your item total:</p>
                    <p class="text-lg font-bold">
                        Rp{{ number_format($cartItems->sum(fn($item) => $item->medicine->price * $item->quantity), 2, ',', '.') }}
                    </p>
                </div>
                <p><strong>For {{ $cartItems->sum('quantity') }} Items</strong></p>
            </div>

            <form action="{{ route('checkout') }}" method="POST" class="mt-4">
                @csrf
                <button class="w-full bg-red-700 text-white py-2 rounded shadow" style="font-family: Inter, sans-serif; font-weight:bold;">
                    Continue to Pay
                </button>
            </form>
        </div>
    </div>
</div>

</body>
