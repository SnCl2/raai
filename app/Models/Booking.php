<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'client_name', 'business_name', 'email', 'phone', 
        'details', 'amount', 'payment_status', 'payment_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
