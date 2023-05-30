<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $table = 'service_orders';

    protected $fillable = [
        'user_id',
        'vehiclePlate',
        'entryDateTime',
        'exitDateTime',
        'priceType',
        'price',
    ];

    protected $casts = [
        'entryDateTime' => 'datetime',
        'exitDateTime' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
