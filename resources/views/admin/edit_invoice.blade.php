<!DOCTYPE html>
<html>
<head>

<title>Edit Invoice</title>

<style>

body{
    font-family:'Segoe UI',sans-serif;
    background:#fff5f8;
    padding:30px;
}

.invoice-box{
    background:white;
    max-width:800px;
    margin:auto;

    padding:30px;

    border-radius:20px;

    box-shadow:
    0 5px 20px rgba(0,0,0,.1);
}

h1{
    color:#ff4b91;
    text-align:center;
}

.input-group{
    margin-bottom:15px;
}

label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}

input,
select{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:10px;
}

.item-box{
    background:#fff0f5;
    padding:15px;
    margin-top:10px;
    border-radius:10px;
}

.btn-save{
    background:#ff4b91;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
    font-weight:bold;
}

.btn-back{
    background:#6c757d;
    color:white;
    text-decoration:none;
    padding:12px 20px;
    border-radius:10px;
}

.button-area{
    margin-top:20px;

    display:flex;
    gap:10px;
}

</style>

</head>
<body>

<div class="invoice-box">

    <h1>📋 Edit Invoice</h1>

    <form
    action="/admin/invoice/{{ $invoice_id }}"
    method="POST">

        @csrf
        @method('PUT')

        <div class="input-group">

            <label>Invoice ID</label>

            <input
            type="text"
            value="{{ $invoice_id }}"
            readonly>

        </div>

        <div class="input-group">

            <label>Nama Pelanggan</label>

            <input
            type="text"
            name="nama"
            value="{{ $orders[0]->nama }}"
            required>

        </div>

        <div class="input-group">

            <label>Nomor HP</label>

            <input
            type="text"
            name="no_hp"
            value="{{ $orders[0]->no_hp }}"
            required>

        </div>

        <div class="input-group">

            <label>Status Pesanan</label>

            <select name="status">

                <option
                value="Pending"
                {{ $orders[0]->status == 'Pending' ? 'selected' : '' }}>
                Pending
                </option>

                <option
                value="Diproses"
                {{ $orders[0]->status == 'Diproses' ? 'selected' : '' }}>
                Diproses
                </option>

                <option
                value="Dikirim"
                {{ $orders[0]->status == 'Dikirim' ? 'selected' : '' }}>
                Dikirim
                </option>

                <option
                value="Selesai"
                {{ $orders[0]->status == 'Selesai' ? 'selected' : '' }}>
                Selesai
                </option>

            </select>

        </div>

        <h3>🍩 Daftar Donat</h3>

        @foreach($orders as $item)

            <div class="item-box">

                <strong>
                    {{ $item->varian_donat }}
                </strong>

                <br>

                {{ $item->custom_rasa }}

                <br><br>

                Rp {{ number_format($item->harga,0,',','.') }}

            </div>

        @endforeach

        <div class="button-area">

            <button
            type="submit"
            class="btn-save">

                💾 Simpan

            </button>

            <a
            href="/admin/orders"
            class="btn-back">

                ← Kembali

            </a>

        </div>

    </form>

</div>

</body>
</html>