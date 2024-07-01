<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_id', 'quantity', 'special_requests', 'confirmed'];

    protected $casts = [
        'confirmed' => 'boolean',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
