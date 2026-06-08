<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Character encoding setup -->
    <meta charset="UTF-8">

    <!-- Makes website responsive on different screen sizes -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Website title shown in browser tab -->
    <title>Dough & Dip Donuts | Dive into Sweetness</title>

    <!-- External CSS file for styling -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @if(session('success'))
    <div id="successModal">

        <div class="modal-content">

            <h2>🎉 Pesanan Berhasil Dicatat!</h2>

            <p>
                Terima kasih telah memesan di
                <strong>Dough & Dip Donuts</strong>.
            </p>

            <p>
                Pesanan Anda akan segera kami proses dan
                tim kami akan menghubungi Anda melalui nomor telepon
                yang telah didaftarkan.
            </p>

            <button onclick="tutupSuccess()">
                Tutup
            </button>

        </div>

    </div>
    @endif

    <!-- ===== NAVIGATION HEADER ===== -->
    <header>
        <nav>
            <ul>
                <li><a href="javascript:void(0)" onclick="bukaProfil()">ABOUT US</a></li>
                <li><a href="javascript:void(0)" onclick="bukaContact()">CONTACT US</a></li>
                <li><a href="/admin/login">🔐ADMIN</a></li>
            </ul>
        </nav>
    </header>

    <!-- ===== HERO SECTION (MAIN LANDING AREA) ===== -->
    <section class="hero">
        <div class="hero-text">
            <!-- Main website heading -->
            <h1>DOUGH & DIP<br>DONUTS</h1>

            <!-- Website tagline -->
            <p>Dive into our world of deliciously dipped creations.</p>

            <!-- Button triggers smooth scrolling -->
            <button class="btn-main" onclick="scrollToDrip()">Start Dippin'</button>
        </div>

        <!-- Hero image -->
        <div class="hero-img">
            <img
                id="heroDonut"
                src="{{ asset('images/StrawberryDonut.png') }}">
        </div>
    </section>

    <!-- Target element for smooth scroll -->
    <div id="target-drip" class="drip-container">
        <div class="drip-overlay"></div>
    </div>

    <!-- ===== PRODUCT SECTION ===== -->
    <section class="products">
        <div class="product-grid">

            <!-- Product card 1 -->
            <div class="card">
                <img src="{{ asset('images/chocolate.png') }}" alt="Classic">
                <h3>Choco Crunch Combo</h3>
                <p>Chocolate Dough + Chocolate Melt Glaze + Choco Chips Delight.</p>

                <!-- Sends product data to JavaScript function -->
                <button class="btn-order" onclick="addToCart('Choco Crunch Combo', 'Chocolate Dough + Chocolate Melt Glaze + Choco Chips Delight', 20000)">Tambah ke Keranjang</button>
            </div>

            <!-- Product card 2 -->
            <div class="card">
                <img src="{{ asset('images/StrawberryDonut.png') }}" alt="Adventure">
                <h3>Berry Sweet Combo</h3>
                <p>Original Dough + Strawberry Bliss Glaze + Fruit Slice.</p>

                <!-- Calls orderMenu() -->
                <button class="btn-order" onclick="addToCart('Berry Sweet Combo', 'Original Dough + Strawberry Bliss Glaze + Fruit Slice', 18000)">Tambah ke Keranjang</button>
            </div>

            <!-- Product card 3 -->
            <div class="card">
                <img src="{{ asset('images/vanilla.png') }}" alt="Season">
                <h3>Classic Creamy Combo</h3>
                <p>Vanilla Dough + Vanilla Cream Glaze + Oreo Crumble.</p>

                <!-- Calls orderMenu() -->
                <button class="btn-order" onclick="addToCart('Classic Creamy Combo', 'Vanilla Dough + Vanilla Cream Glaze + Oreo Crumble', 16000)">Tambah ke Keranjang</button>
            </div>
        </div>
    </section>

    <!-- ===== BUILD YOUR OWN DONUT SECTION ===== -->
    <section class="build-own">
        <div class="build-container">

            <!-- Decorative donut image -->
            <div class="floating-donuts">
                <img src="{{ asset('images/donut.png') }}" alt="Donuts">
            </div>

            <div class="build-form">
                <h2>Build Your Own.</h2>

                <form>
                    @csrf

                    <div class="form-group">

                        <select id="dough" name="varian_donat" onchange="hitungHarga()">
                            <option value="">Pilih Dough</option>
                            <option value="Original Glazed">Original Glazed</option>
                            <option value="Chocolate Dough">Chocolate Dough</option>
                            <option value="Strawberry Dough">Strawberry Dough</option>
                            <option value="Vanilla Dough">Vanilla Dough</option>
                            <option value="Matcha Dough">Matcha Dough</option>
                        </select>

                        <select id="glaze" onchange="hitungHarga()">
                            <option value="">Pilih Glaze</option>
                            <option value="Strawberry Bliss">Strawberry Bliss</option>
                            <option value="Lemon Yellow">Lemon Yellow</option>
                            <option value="Chocolate Melt">Chocolate Melt</option>
                            <option value="Vanilla Cream">Vanilla Cream</option>
                            <option value="Matcha Green Tea">Matcha Green Tea</option>
                            <option value="Honey Sugar">Honey Sugar</option>
                            <option value="Coffee Latte">Coffee Latte</option>
                        </select>

                        <select id="topping" onchange="hitungHarga()">
                            <option value="">Pilih Topping</option>
                            <option value="Rainbow Sprinkles">Rainbow Sprinkles</option>
                            <option value="Crushed Nuts">Crushed Nuts</option>
                            <option value="Choco Chips Delight">Choco Chips Delight</option>
                            <option value="Oreo Crumble">Oreo Crumble</option>
                            <option value="Biscuit Crumbs">Biscuit Crumbs</option>
                            <option value="Fruit Slice">Fruit Slice</option>
                        </select>

                        <input type="hidden"
                            name="custom_rasa"
                            id="custom_rasa">

                        <input
                            type="hidden"
                            id="harga"
                            value="0">

                        <div class="price-box">
                            Total Harga:
                            <span id="totalHarga">Rp 0</span>
                        </div>

                        <button
                            type="button"
                            class="btn-submit"
                            onclick="addCustomToCart()">

                            Tambah ke Keranjang

                        </button>

                    </div>
                </form>
            </div>
            </div>
        </div>
    </section>

    <!-- ===== ABOUT MODAL ===== -->
    <div id="aboutModal" class="modal">
    <div class="modal-content">

        <!-- Close modal button -->
        <span class="close-btn" onclick="tutupModal()">&times;</span>

        <h2>About Us</h2>

        <!-- Team member profiles -->
        <div class="team-container">
            <div class="profile-card">
                <img src="{{ asset('images/Nova.jpg') }}" alt="Nova">
                <p class="name">Nova Dwi Riyanti</p>
                <p class="nim">2403421045</p>
                <p class="college">Politeknik Negeri Jakarta</p>
            </div>

            <div class="profile-card">
                <img src="{{ asset('images/Salwa.jpg') }}" alt="Salwa">
                <p class="name">Salwa Azhar Nursyifa</p>
                <p class="nim">2403421002</p>
                <p class="college">Politeknik Negeri Jakarta</p>
            </div>
        </div>
    </div>
    </div>

    <!-- ===== CONTACT MODAL ===== -->
    <div id="contactModal" class="modal">
    <div class="modal-content">

        <!-- Close modal -->
        <span class="close-btn" onclick="tutupContact()">&times;</span>

        <h2>Contact Us</h2>

        <!-- Email contact information -->
        <div class="contact-container">
            <div class="contact-box">
                <p>📧 <a href="https://mail.google.com/mail/?view=cm&fs=1&to=nova.dwi.riyanti.te24@stu.pnj.ac.id"
target="_blank">nova.dwi.riyanti.te24@stu.pnj.ac.id</a></p>
                <p>📧 <a href="https://mail.google.com/mail/?view=cm&fs=1&to=salwa.azhar.nursyifa.te24@stu.pnj.ac.id"
target="_blank">salwa.azhar.nursyifa.te24@stu.pnj.ac.id</a></p>
            </div>

            <p style="margin-top: 20px; color: #888; font-size: 0.9rem;">
                Hubungi kami untuk informasi lebih lanjut mengenai pesanan Anda.
            </p>
        </div>
    </div>
</div>

<div id="toast" class="toast-notif">
</div>

    <section class="cart-section">
    <h2>🛒 Keranjang Pesanan</h2>
    <div id="cartItems">
        Belum ada item
    </div>
    <br>
    <p>
        Total Item :
        <span id="cartTotal">0</span>
    </p>
    <p>
        Total Harga :
        <span id="cartHarga">Rp 0</span>
    </p>

    <form action="/checkout-cart" method="POST">

        @csrf

        <input
            type="text"
            name="nama"
            placeholder="Nama Pelanggan"
            required>

        <input
            type="text"
            name="no_hp"
            placeholder="Nomor HP"
            required>

        <input
            type="hidden"
            id="cart_data"
            name="cart_data">

        <input
            type="hidden"
            id="total_harga"
            name="total_harga">

        <button
            type="submit"
            onclick="prepareCheckout()">

            Checkout

        </button>

    </form>
    </section>

    <script>
    const customForm = document.querySelector('.build-form form');

    if(customForm){
        customForm.addEventListener('submit', function() {

            const glaze =
                document.getElementById('glaze').value;

            const topping =
                document.getElementById('topping').value;

            document.getElementById('custom_rasa').value =
                'Glaze: ' + glaze +
                ', Topping: ' + topping;
        });
    }

    /* We use document.getElementById() to access HTML elements 
    so JavaScript can read user input and modify the webpage dynamically */
    // Handles custom donut order
    const doughPrice = {
        "Original Glazed": 10000,
        "Chocolate Dough": 12000,
        "Strawberry Dough": 13000,
        "Vanilla Dough": 12000,
        "Matcha Dough": 15000
    };

    const glazePrice = {
        "Strawberry Bliss": 3000,
        "Lemon Yellow": 3000,
        "Chocolate Melt": 4000,
        "Vanilla Cream": 4000,
        "Matcha Green Tea": 5000,
        "Honey Sugar": 3000,
        "Coffee Latte": 4000
    };

    const toppingPrice = {
        "Rainbow Sprinkles": 2000,
        "Crushed Nuts": 3000,
        "Choco Chips Delight": 4000,
        "Oreo Crumble": 4000,
        "Biscuit Crumbs": 3000,
        "Fruit Slice": 5000
    };

    function orderCustom() {

        const dough = document.getElementById('dough').value;
        const glaze = document.getElementById('glaze').value;
        const topping = document.getElementById('topping').value;

        if (dough === "" || glaze === "" || topping === "") {

            alert("Mohon lengkapi semua pilihan donat kustom Anda!");

        } else {

            alert('🛒 Item ditambahkan ke keranjang');}
    }

    // Adds animation effect while scrolling
    window.addEventListener('scroll', () => {
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const speed = 0.05;
            const rect = card.getBoundingClientRect();

            // Apply movement when card enters viewport
            if(rect.top < window.innerHeight) {
                card.style.transform = `translateY(${window.scrollY * speed}px)`;
            }
        });
    });

    // Smooth scrolling to drip section
    function scrollToDrip() {
        const target = document.getElementById("target-drip");

        target.scrollIntoView({
            behavior: "smooth", // smooth animation
            block: "start"      // align to top
        });
    }

    // Open About modal
    function bukaProfil() {
        document.getElementById("aboutModal").style.display = "block";
    }

    // Close About modal
    function tutupModal() {
        document.getElementById("aboutModal").style.display = "none";
    }

    // Open Contact modal
    function bukaContact() {
        document.getElementById("contactModal").style.display = "block";
    }

    // Close Contact modal
    function tutupContact() {
        document.getElementById("contactModal").style.display = "none";
    }

    function tutupSuccess() {
        document.getElementById("successModal").style.display = "none";
    }
    // Close both modals when clicking outside
    window.onclick = function(event) {
        let aboutModal = document.getElementById("aboutModal");
        let contactModal = document.getElementById("contactModal");

        if (event.target == aboutModal) {
            aboutModal.style.display = "none";
        }
        if (event.target == contactModal) {
            contactModal.style.display = "none";
        }
    }

    //Fungsi Hitung Harga
    function hitungHarga() {

        const dough = document.getElementById('dough').value;
        const glaze = document.getElementById('glaze').value;
        const topping = document.getElementById('topping').value;

        let total = 0;

        if (dough) {
            total += doughPrice[dough];
        }

        if (glaze) {
            total += glazePrice[glaze];
        }

        if (topping) {
            total += toppingPrice[topping];
        }

        document.getElementById('totalHarga').innerHTML =
            "Rp " + total.toLocaleString('id-ID');

        document.getElementById("harga").value = total;
    }

    let cart = [];

    function addToCart(nama, deskripsi, harga)
    {
        cart.push({
            nama: nama,
            deskripsi: deskripsi,
            harga: harga
        });

        updateCart();

        alert('✅ ' + nama + ' ditambahkan ke keranjang');
    }

    function removeFromCart(index)
    {
        cart.splice(index, 1);

        updateCart();
    }

    function updateCart()
    {
        let html = "";
        let totalHarga = 0;

        cart.forEach((item, index) => {

            html += `
                <div class="cart-item">

                    <strong>${item.nama}</strong><br>

                    ${item.deskripsi}<br>

                    Rp ${Number(item.harga).toLocaleString('id-ID')}

                    <br><br>

                    <button
                        type="button"
                        class="btn-delete"
                        onclick="removeFromCart(${index})">

                        ❌ Hapus

                    </button>

                </div>
                <hr>
            `;

            totalHarga += Number(item.harga);

        });

        if(cart.length === 0)
        {
            document.getElementById("cartItems").innerHTML =
                "Belum ada item";

            document.getElementById("cartTotal").innerText = 0;

            document.getElementById("cartHarga").innerText =
                "Rp 0";

            return;
        }

        document.getElementById("cartItems").innerHTML = html;

        document.getElementById("cartTotal").innerText =
            cart.length;

        document.getElementById("cartHarga").innerText =
            "Rp " + totalHarga.toLocaleString('id-ID');
    }

    function addCustomToCart()
    {
        const dough =
            document.getElementById('dough').value;

        const glaze =
            document.getElementById('glaze').value;

        const topping =
            document.getElementById('topping').value;

        if(!dough || !glaze || !topping)
        {
            alert('Lengkapi pilihan donat dulu!');
            return;
        }

        const total =
            Number(document.getElementById('harga').value);

        const deskripsi =
            dough +
            ' + ' +
            glaze +
            ' + ' +
            topping;

        cart.push({
            nama: 'Custom Donut',
            deskripsi: deskripsi,
            harga: total
        });

        updateCart();

        alert('✅ Custom Donut ditambahkan ke keranjang');
    }

    function prepareCheckout(event)
    {
        if(cart.length === 0)
        {
            alert('Keranjang masih kosong!');
            event.preventDefault();
            return;
        }

        document.getElementById('cart_data').value =
            JSON.stringify(cart);

        let total = 0;

        cart.forEach(item => {
            total += Number(item.harga);
        });

        document.getElementById('total_harga').value =
            total;
    }

    const donut =
        document.getElementById('heroDonut');

    document.addEventListener('mousemove', (e) => {

        const x =
            (window.innerWidth / 2 - e.clientX) / 30;

        const y =
            (window.innerHeight / 2 - e.clientY) / 30;

        donut.style.transform =
            `translate(${x}px, ${y}px)`;
    });
    </script>
</body>
</html>