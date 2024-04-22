<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;
    protected $fillable= [
        'sale_date',
        'total_price',
        'customer_id',
        'user_id',
        'bayar',
        'kembalian',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_sales()
    {
        return $this->hasMany(detail_sales::class);
    }
}
