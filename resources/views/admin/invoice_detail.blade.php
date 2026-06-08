<!DOCTYPE html>
<html>
<head>
    <title>Detail Invoice</title>

    <style>
        .invoice-box{
            width:80%;
            margin:30px auto;

            background:white;

            padding:30px;

            border-radius:20px;

            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }

        .invoice-box h1,
        .invoice-box h2{
            text-align:center;
            color:#ff4b91;
        }

        .invoice-box table{
            width:100%;
            border-collapse:collapse;
        }

        .invoice-box th{
            background:#ff4b91;
            color:white;
            padding:12px;
        }

        .invoice-box td{
            padding:12px;
            border-bottom:1px solid #eee;
        }

        .btn-detail{
            background:#17a2b8;
            color:white;

            padding:8px 12px;

            border-radius:8px;

            text-decoration:none;
        }

        .btn-back{
            display:inline-block;

            margin-top:20px;

            background:#ff4b91;

            color:white;

            padding:10px 20px;

            border-radius:10px;

            text-decoration:none;
        }
    </style>
</head>
<body>

<div class="invoice-box">

    <h1>
        Invoice
    </h1>

    <h2>
        {{ $invoice }}
    </h2>

    <hr>

    <p>
        Nama :
        {{ $orders->first()->nama }}
    </p>

    <p>
        No HP :
        {{ $orders->first()->no_hp }}
    </p>

    <p>
        Tanggal :
        {{ $orders->first()->created_at }}
    </p>

    <br>

    <table>

        <tr>
            <th>Menu</th>
            <th>Deskripsi</th>
            <th>Harga</th>
        </tr>

        @foreach($orders as $order)

        <tr>

            <td>
                {{ $order->varian_donat }}
            </td>

            <td>
                {{ $order->custom_rasa }}
            </td>

            <td>
                Rp {{ number_format($order->harga,0,',','.') }}
            </td>

        </tr>

        @endforeach

    </table>

    <h3>

        Total :

        Rp {{ number_format($totalHarga,0,',','.') }}

    </h3>

    <a
    href="/admin/orders"
    class="btn-back">

    ← Kembali

    </a>

</div>

</body>
</html>