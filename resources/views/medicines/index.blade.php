<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Telkomedika</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/medicine_index.css') }}" />
</head>

<body>
<div id="header">
    <header>
        <div class="logo">
            <a href="{{ route('patients.index') }}">
                <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika" />
            </a>
        </div>
    </header>
</div>

<div class="medicine_body">
    <div class="medicine_title">
        <h1>MEDICINE</h1>
        <hr />
    </div>

    <div class="search-bar">
        <form action="{{ route('medicines.index') }}" method="GET">
            <input type="text" name="query" placeholder="Example: Cetirizine 20mg" value="{{ request()->input('query') }}" />
            <button type="submit">Search</button>
        </form>
    </div>

    @if($medicines->isEmpty())
        <p>No medicines available.</p>
    @else
        @foreach ($medicines as $medicine)
            <div class="product-list">
                <div class="product-card">
                    {{-- Display medicine image if exists --}}
                    @if($medicine->image && file_exists(public_path($medicine->image)))
                        <img src="{{ asset($medicine->image) }}" alt="{{ $medicine->medicine_name }}" />
                    @else
                        <img src="{{ asset('images/medicines/default.png') }}" alt="No Image Available" />
                    @endif

                    <div class="product-details">
                        <div class="product_text">
                            <div class="product_text_child">
                                <div class="product-title">{{ $medicine->medicine_name }}</div>
                                <div>Per Strip</div>
                                <div class="stock">Stock: {{ $medicine->stock }}</div>
                                <p>{{ $medicine->description }}</p>
                            </div>
                            <div class="price" data-price="{{ $medicine->price }}">
                                <div class="product-price">Rp{{ number_format($medicine->price, 2, ',', '.') }}</div>
                            </div>
                        </div>

                        <form action="{{ route('cart.add', $medicine->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input" style="height:30px; width:30px; border-radius: 3px;">
                            <button dusk="submit-cart" type="submit" class="add-to-cart-button" title="Add this item to your cart">
                                Add to Cart
                            </button>
                        </form>

                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if($cartCount > 0)
    <div class="cart-summary">
        <div class="cart-summary-left">
            <div class="cart-summary-item">{{ $cartCount }} Item</div>
            <div class="cart-summary-cost">
                <div>Estimated Cost</div>
                <strong>Rp. {{ number_format($estimatedTotal ?? 0, 0, ',', '.') }}</strong>

            </div>
        </div>
        <a dusk='see-cart' href="{{ route('cart.index') }}" class="cart-summary-button">See Cart</a>
    </div>
    @endif

</div>


<footer>
    <img src="{{ asset('icons/logo.png') }}" alt="telkomedika" />
    <div class="footer_text">
        <div class="book_footer">
            <h1>Book Now</h1>
            <hr />
            <div class="footer_opt">
                <a href="{{ url('appointments') }}">Book Appointment</a>
            </div>
        </div>
        <div class="discover_footer">
            <h1>Discover Us</h1>
            <hr />
            <div class="footer_opt">
                <a href="#services">Services</a>
                <a href="#about_us">About Us</a>
                <a href="{{ url('doctors') }}">Our Doctors</a>
            </div>
        </div>
        <div class="contact_footer">
            <h1>Contact Us</h1>
            <hr />
            <div class="footer_opt">
                <a href="tel:1500115">1500115</a>
                <a href="mailto:cs@telkomedika.co.id">cs@telkomedika.co.id</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
