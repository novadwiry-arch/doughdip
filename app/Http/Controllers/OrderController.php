<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect('/admin/orders')
            ->with('success', 'Pesanan berhasil dihapus');
    }

    public function orders(Request $request)
    {
        $search = $request->search;

        $orders = Order::select(
                'invoice_id',
                'nama',
                'no_hp',
                'status'
            )
            ->selectRaw('COUNT(*) as total_item')
            ->selectRaw('SUM(harga) as total_harga')
            ->groupBy(
                'invoice_id',
                'nama',
                'no_hp',
                'status'
            )
            ->latest('invoice_id')
            ->get();

        $total = Order::count();

        $pending = Order::where('status', 'Pending')->count();

        $diproses = Order::where('status', 'Diproses')->count();

        $dikirim = Order::where('status', 'Dikirim')->count();

        $selesai = Order::where('status', 'Selesai')->count();

        $omzet = Order::sum('harga');

        return view(
            'admin.orders',
            compact(
                'orders',
                'total',
                'pending',
                'diproses',
                'dikirim',
                'selesai',
                'omzet',
                'search'
            )
        );
    }

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);

        if($order->status == 'Pending'){
            $order->status = 'Diproses';
        }
        elseif($order->status == 'Diproses'){
            $order->status = 'Dikirim';
        }
        else{
            $order->status = 'Selesai';
        }

        $order->save();

        return redirect()->back();
    }

    public function exportPdf()
    {
        $orders = Order::all();

        $pdf = Pdf::loadView(
            'admin.pdf_orders',
            compact('orders')
        );

        return $pdf->download('laporan-pesanan-doughdip.pdf');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view(
            'admin.edit_order',
            compact('order')
        );
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->nama = $request->nama;
        $order->no_hp = $request->no_hp;
        $order->varian_donat = $request->varian_donat;
        $order->status = $request->status;

        $order->save();

        return redirect('/admin/orders')
            ->with('success', 'Pesanan berhasil diupdate');
    }

    public function checkoutCart(Request $request)
    {
        $cart = json_decode($request->cart_data, true);

        $invoiceId =
            'INV-' .
            now()->format('YmdHis');

        foreach($cart as $item)
        {
            Order::create([

                'invoice_id' => $invoiceId,

                'nama' => $request->nama,
                'no_hp' => $request->no_hp,

                'varian_donat' => $item['nama'],
                'custom_rasa' => $item['deskripsi'],

                'harga' => $item['harga'],
                'jumlah' => 1,

                'status' => 'Pending'
            ]);
        }

        return redirect('/')
            ->with('success', 'Checkout berhasil');
    }

    public function invoiceDetail($invoice)
    {
        $orders = Order::where(
            'invoice_id',
            $invoice
        )->get();

        $totalHarga = $orders->sum('harga');

        return view(
            'admin.invoice_detail',
            compact(
                'orders',
                'invoice',
                'totalHarga'
            )
        );
    }

    public function updateInvoiceStatus($invoice)
    {
        $orders = Order::where(
            'invoice_id',
            $invoice
        )->get();

        foreach($orders as $order)
        {
            if($order->status == 'Pending')
            {
                $order->status = 'Diproses';
            }
            elseif($order->status == 'Diproses')
            {
                $order->status = 'Dikirim';
            }
            elseif($order->status == 'Dikirim')
            {
                $order->status = 'Selesai';
            }

            $order->save();
        }

        return back();
    }

    public function deleteInvoice($invoice)
    {
        Order::where(
            'invoice_id',
            $invoice
        )->delete();

        return back()
            ->with(
                'success',
                'Invoice berhasil dihapus'
            );
    }

    public function editInvoice($invoice_id)
    {
        $orders = Order::where(
            'invoice_id',
            $invoice_id
        )->get();

        return view(
            'admin.edit_invoice',
            compact(
                'orders',
                'invoice_id'
            )
        );
    }

    public function updateInvoice(
        Request $request,
        $invoice_id
    )
    {
        Order::where(
            'invoice_id',
            $invoice_id
        )->update([

            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'status' => $request->status

        ]);

        return redirect('/admin/orders')
            ->with(
                'success',
                'Invoice berhasil diperbarui'
            );
    }
}