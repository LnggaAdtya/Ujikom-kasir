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
    ];

    public function detail_sales()
    {
        return $this->hasMany(detail_sales::class);
    }
}
