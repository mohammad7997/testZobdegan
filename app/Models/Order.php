<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function installmentPay()
    {
        return $this->hasOne(InstallmentPay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
