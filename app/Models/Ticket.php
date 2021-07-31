<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'type', 'description', 'image', 'property', 'priceCash', 'priceInstallment', 'parent', 'descriptionTopFactor', 'descriptionBottomFactor'
    ];

    public function InstallmentFeature()
    {
        return $this->hasOne(InstallmentFeature::class);
    }
}
