<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentFeature extends Model
{
    use HasFactory;

    protected $fillable=[
        'installmentTime','installmentNum','prepayment','ticket_id'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
