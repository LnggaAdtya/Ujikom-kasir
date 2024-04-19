<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'no_hp',
    ];

    public function sale()
    {
        return $this->hasOne(sales::class);
    }

    
}
