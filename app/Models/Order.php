<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'session_id',
        'customer_email',
        'amount_total',
        'currency',
        'items',
        'status'
    ];




}
