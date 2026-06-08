<!DOCTYPE html>
<html>
<head>
    <title>Admin Orders</title>
    <style>
    body{
        font-family:'Segoe UI',sans-serif;
        background:#fff5f8;
        padding:30px;
    }

    /* ================= HEADER ================= */

    .admin-header{
        position:relative;
        background:linear-gradient(
            135deg,
            #ff4b91,
            #ff7eb3
        );
        padding:25px;
        margin-bottom:30px;
        border-radius:20px;
        text-align:center;
        box-shadow:0 8px 20px rgba(255,75,145,.25);
    }

    .admin-header h1{
        color:white;
        margin:0;
        font-size:30px;
        font-weight:bold;
    }

    .btn-logout{
        position:absolute;
        right:20px;
        top:50%;
        transform:translateY(-50%);
        background:white;
        color:#ff4b91;
        text-decoration:none;
        padding:10px 18px;
        border-radius:12px;
        font-weight:bold;
        transition:.3s;
    }

    .btn-logout:hover{
        background:#ffe6f0;
        transform:translateY(-50%) scale(1.05);
    }

    /* ================= DASHBOARD ================= */

    .dashboard-box{
        display:flex;
        gap:20px;
        margin-bottom:30px;
        flex-wrap:wrap;
    }

    .box{
        flex:1;
        min-width:200px;
        background:white;
        padding:25px;
        border-radius:20px;
        text-align:center;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
    }

    .box h3{
        margin:0;
        color:#888;
    }

    .box h2{
        color:#ff4b91;
        margin-top:10px;
        font-size:32px;
    }

    /* ================= SEARCH ================= */

    .search-box{
        text-align:center;
        margin-bottom:20px;
    }

    .search-box input{
        width:300px;
        padding:10px;
        border-radius:10px;
        border:1px solid #ddd;
    }

    .search-box button{
        background:#d63384;
        color:white;
        border:none;
        padding:10px 20px;
        border-radius:10px;
        cursor:pointer;
    }

    /* ================= EXPORT ================= */

    .export-container{
        text-align:center;
        margin-bottom:25px;
    }

    .btn-export{
        background:#198754;
        color:white;
        text-decoration:none;
        padding:12px 25px;
        border-radius:12px;
        font-weight:bold;
        display:inline-block;
        transition:.3s;
    }

    .btn-export:hover{
        background:#157347;
        transform:translateY(-2px);
    }

    /* ================= CHART ================= */

    .chart-container{
        background:white;
        padding:30px;
        border-radius:20px;
        margin:30px auto;
        width:500px;
        max-width:90%;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
    }

    .chart-container h2{
        text-align:center;
        color:#ff4b91;
    }

    #orderChart{
        width:300px !important;
        height:300px !important;
        margin:auto;
    }

    /* ================= TABLE ================= */

    .order-table{
        width:100%;
        border-collapse:collapse;
        background:white;
        border-radius:15px;
        overflow:hidden;
        box-shadow:0 5px 20px rgba(0,0,0,.1);
    }

    .order-table th{
        background:#ff4b91;
        color:white;
        padding:15px;
        text-align:center;
    }

    .order-table td{
        padding:12px;
        text-align:center;
        border-bottom:1px solid #eee;
    }

    .order-table tr:hover{
        background:#fff0f5;
    }

    /* ================= ACTION BUTTON ================= */

    .aksi-cell{
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
        gap:8px;
    }

    .btn-action{
        display:inline-block;
        padding:8px 14px;
        border:none;
        border-radius:10px;
        text-decoration:none;
        color:white;
        font-size:14px;
        font-weight:600;
        cursor:pointer;
        transition:.3s;
    }

    .btn-action:hover{
        transform:translateY(-2px);
        box-shadow:0 5px 12px rgba(0,0,0,.2);
    }

    /* warna tombol */

    .btn-detail{
        background:#0d6efd;
    }

    .btn-wa{
        background:#25D366;
    }

    .btn-edit{
        background:#ff4b91;
    }

    .btn-status{
        background:#fd7e14;
    }

    .btn-delete{
        background:#dc3545;
    }

    .empty-search{
        padding:30px;
        text-align:center;

        color:#888;
        font-size:16px;
    }
    </style>
</head>
<body>

<div class="admin-header">

    <h1>🍩 Dough & Dip Donuts Admin Dashboard 🍩</h1>

    <a href="/admin/logout"
       class="btn-logout"
       onclick="return confirm('Yakin ingin logout dari Dashboard Admin?')">

        🚪 Logout

    </a>

</div>

<div class="dashboard-box">

    <div class="box">
        <h3>Total Pesanan</h3>
        <h2>{{ $total }}</h2>
    </div>

    <div class="box">
        <h3>Pending</h3>
        <h2>{{ $pending }}</h2>
    </div>

    <div class="box">
        <h3>Diproses</h3>
        <h2>{{ $diproses }}</h2>
    </div>

    <div class="box">
        <h3>Selesai</h3>
        <h2>{{ $selesai }}</h2>
    </div>

    <div class="box">
        <h3>Total Omzet</h3>
        <h2>Rp {{ number_format($omzet,0,',','.') }}</h2>
    </div>

</div>

<br>

<form method="GET" action="/admin/orders" class="search-box">
    <input
        type="text"
        name="search"
        placeholder="Cari nama pelanggan..."
        value="{{ $search ?? '' }}"
    >

    <button type="submit">
        Cari
    </button>
</form>

<br>

<div class="export-container">
    <a href="/admin/export-pdf" class="btn-export">
        📄 Export PDF
    </a>
</div>

<br><br>

<div class="chart-container">

    <h2>Status Pesanan</h2>

    <canvas id="orderChart"></canvas>

</div>

<table class="order-table">
    <thead>
        <tr>
            <th>Invoice</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Total Item</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Settings</th>
        </tr>
    </thead>
    
    <tbody>

    @foreach($orders as $order)

    <tr>

        <td>{{ $order->invoice_id }}</td>

        <td>{{ $order->nama }}</td>

        <td>{{ $order->no_hp }}</td>

        <td>{{ $order->total_item }}</td>

        <td>
            Rp {{ number_format($order->total_harga,0,',','.') }}
        </td>

        <td>

            @if($order->status == 'Pending')
                <span class="status-pending">
                    Pending
                </span>

            @elseif($order->status == 'Diproses')
                <span class="status-proses">
                    Diproses
                </span>

            @elseif($order->status == 'Dikirim')
                <span class="status-kirim">
                    Dikirim
                </span>

            @else
                <span class="status-selesai">
                    Selesai
                </span>
            @endif

        </td>

        <td class="aksi-cell">

            <a
            href="/admin/invoice/{{ $order->invoice_id }}"
            class="btn-action btn-detail">
                Detail
            </a>

            <a
            href="/admin/invoice/{{ $order->invoice_id }}/edit"
            class="btn-action btn-edit">
                Edit Invoice
            </a>

            <a
            target="_blank"
            href="https://wa.me/{{ $order->no_hp }}"
            class="btn-action btn-wa">
                WhatsApp
            </a>

            <form
            action="/admin/invoice/status/{{ $order->invoice_id }}"
            method="POST"
            style="display:inline;">

                @csrf

                <button class="btn-action btn-status">Status</button>

            </form>

            <form
            action="/admin/invoice/{{ $order->invoice_id }}"
            method="POST"
            style="display:inline;">

                @csrf
                @method('DELETE')

                <button class="btn-action btn-delete">Hapus</button>

            </form>

        </td>

    </tr>

    @endforeach
    </tbody>

</table>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

const ctx =
document.getElementById('orderChart');

new Chart(ctx, {

    type: 'doughnut',

    data: {

        labels: [
            'Pending',
            'Diproses',
            'Dikirim',
            'Selesai'
        ],

        datasets: [{

            data: [
                {{ $pending }},
                {{ $diproses }},
                {{ $dikirim }},
                {{ $selesai }}
            ],

            backgroundColor: [
                '#ffc107',
                '#0dcaf0',
                '#6f42c1',
                '#198754'
            ]

        }]
    }
});

</script>
</body>
</html>