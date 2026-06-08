<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pesanan</title>

    <style>

        body{
            font-family: Arial, sans-serif;
        }

        h1{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:10px;
            text-align:center;
        }

    </style>
</head>
<body>

    <h1>🍩 DOUGH & DIP DONUTS</h1>

    <h3 style="text-align:center;">
        LAPORAN PESANAN
    </h3>

    <table>

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Varian</th>
            <th>Status</th>
        </tr>

        @foreach($orders as $order)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->nama }}</td>
            <td>{{ $order->no_hp }}</td>
            <td>{{ $order->varian_donat }}</td>
            <td>{{ $order->status }}</td>
        </tr>

        @endforeach

    </table>

</body>
</html>