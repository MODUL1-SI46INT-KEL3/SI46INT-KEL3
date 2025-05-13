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

                        <div class="quantity-controls" id="quantity-controls-{{ $loop->index }}" style="display: none;">
                            <button type="button" onclick="updateQuantity(-1, {{ $loop->index }})">-</button>
                            <span id="quantity-{{ $loop->index }}">1</span>
                            <button type="button" onclick="updateQuantity(1, {{ $loop->index }})">+</button>
                            <span style="margin-left: 10px; cursor: pointer;" onclick="cancelQuantityControls({{ $loop->index }})">Cancel</span>
                            <span id="total-price-{{ $loop->index }}" style="margin-left: 10px;">Total: Rp{{ number_format($medicine->price, 2, ',', '.') }}</span>
                        </div>

                        <button class="add-to-cart-button" onclick="addToCart({{ $loop->index }}, '{{ $medicine->medicine_name }}', {{ $medicine->price }}, {{ $medicine->stock }})">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div id="cart-popup">
    <h3>Your Cart</h3>
    <div id="cart-items"></div>
    <p id="cart-total">Total: Rp0</p>

    <button onclick="clearCart()">Clear Cart</button>
    <button onclick="closeCartPopup()">Close</button>
    <div class="order-buttons">
        <button onclick="placeOrder()">Place Order</button>
    </div>
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

<script>
let cart = {};

function addToCart(index, medicineName, price, stock) {
    const quantity = parseInt(document.getElementById(`quantity-${index}`).innerText);

    if (cart[medicineName]) {
        if (cart[medicineName].quantity + quantity > stock) {
            alert(`You cannot add more than the available stock (${stock}) of ${medicineName}.`);
            return;
        }
        cart[medicineName].quantity += quantity;
    } else {
        if (quantity > stock) {
            alert(`You cannot add more than the available stock (${stock}) of ${medicineName}.`);
            return;
        }
        cart[medicineName] = { quantity, price, stock };
    }

    updateCartPopup();
    showCartPopup();
}

function updateCartPopup() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');

    cartItemsContainer.innerHTML = '';
    let total = 0;

    for (const [medicineName, details] of Object.entries(cart)) {
        const itemTotal = details.quantity * details.price;
        total += itemTotal;

        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
            <p>${medicineName}</p>
            <div>
                <button onclick="updateCartItem('${medicineName}', -1, ${details.stock})">-</button>
                <span>${details.quantity}</span>
                <button onclick="updateCartItem('${medicineName}', 1, ${details.stock})">+</button>
                <span>Rp${itemTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</span>
            </div>
        `;
        cartItemsContainer.appendChild(itemElement);
    }

    cartTotalElement.innerText = `Total: Rp${total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`;
}

function updateCartItem(medicineName, change, stock) {
    if (cart[medicineName]) {
        if (change === 1 && cart[medicineName].quantity + 1 > stock) {
            alert(`You cannot add more than the available stock (${stock}) of ${medicineName}.`);
            return;
        }

        cart[medicineName].quantity += change;

        if (cart[medicineName].quantity <= 0) {
            delete cart[medicineName];
        }
    }

    updateCartPopup();
}

function clearCart() {
    cart = {};
    updateCartPopup();
}

function showCartPopup() {
    const cartPopup = document.getElementById('cart-popup');
    if (cartPopup) {
        cartPopup.style.display = 'block';
    } else {
        console.error("Cart popup element not found.");
    }
}

function closeCartPopup() {
    document.getElementById('cart-popup').style.display = 'none';
}

function placeOrder() {
    alert("Your purchase has been made!");
    closeCartPopup();
}
</script>
</body>
</html>