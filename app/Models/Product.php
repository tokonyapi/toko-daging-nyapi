<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orders() {
        return $this->hasMany(Orders::class);
    }
}
