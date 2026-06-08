<!DOCTYPE html>
<html>
<head>
    <title>Edit Pesanan</title>
    <style>
        .edit-container{
            width:600px;
            margin:50px auto;
            background:white;
            padding:35px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
        }

        .edit-container h2{
            text-align:center;
            color:#ff4b91;
            margin-bottom:25px;
        }

        .edit-container label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
            color:#555;
        }

        .edit-container input,
        .edit-container select{
            width:100%;
            padding:12px;
            margin-bottom:18px;
            border:1px solid #ddd;
            border-radius:12px;
            box-sizing:border-box;
            font-size:14px;
        }

        .edit-container input:focus,
        .edit-container select:focus{
            outline:none;
            border-color:#ff4b91;
            box-shadow:0 0 8px rgba(255,75,145,0.3);
        }

        .btn-save{
            width:100%;
            background:#ff4b91;
            color:white;
            border:none;
            padding:14px;
            border-radius:12px;
            font-size:15px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }

        .btn-save:hover{
            background:#d63384;
            transform:translateY(-2px);
        }
    </style>
</head>
<body>

<div class="edit-container">

    <h2>✏️ Edit Pesanan</h2>

    <!-- form disini -->

</div>

<form action="/admin/orders/{{ $order->id }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">

        <label>Nama Pelanggan</label>
        <input
            type="text"
            name="nama"
            value="{{ $order->nama }}"
            required>

        <label>Nomor HP</label>
        <input
            type="text"
            name="no_hp"
            value="{{ $order->no_hp }}"
            required>

        <label>Varian Donat</label>
        <input
            type="text"
            name="varian_donat"
            value="{{ $order->varian_donat }}"
            required>

        <label>Status Pesanan</label>
        <select name="status">

            <option value="Pending"
                {{ $order->status == 'Pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="Diproses"
                {{ $order->status == 'Diproses' ? 'selected' : '' }}>
                Diproses
            </option>

            <option value="Dikirim"
                {{ $order->status == 'Dikirim' ? 'selected' : '' }}>
                Dikirim
            </option>

            <option value="Selesai"
                {{ $order->status == 'Selesai' ? 'selected' : '' }}>
                Selesai
            </option>

        </select>

        <button type="submit" class="btn-save">
            💾 Simpan Perubahan
        </button>

    </div>

</form>

</body>
</html>