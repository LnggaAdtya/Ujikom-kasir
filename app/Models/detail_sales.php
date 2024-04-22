<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_sales extends Model
{
    use HasFactory;
    protected $fillable = [
        'sales_id',
        'product_id',
        'amount',
        'sub_total',

    ];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function sale()
    {
        return $this->belongsTo(sales::class);
    }
}
