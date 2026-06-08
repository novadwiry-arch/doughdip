<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice_id',
        'nama',
        'no_hp',
        'varian_donat',
        'custom_rasa',
        'harga',
        'jumlah',
        'status'
    ];
}