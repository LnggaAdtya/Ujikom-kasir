<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'price',
        'stok',
        'image',
    ];
    public function detail_sales()
    {
        return $this->hasMany(detail_sales::class);
    }
}
