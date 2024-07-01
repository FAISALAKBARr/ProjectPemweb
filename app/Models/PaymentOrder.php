<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrder extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'user_id',
        'amount', 
        'item_number', 
        'date', 
        'time', 
        'proofPath',
        'confirmed'
    ];

    protected $table = 'foodpayments';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
