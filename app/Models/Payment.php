<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            // Ensure we don't overwrite an existing external_id
            if (empty($invoice->external_id)) {
                $payment->external_id = static::generateUniqueExternalId();
            }
        });
    }

    protected static function generateUniqueExternalId()
    {
        do {
            $randomId = random_int(1000000000, PHP_INT_MAX);
        }
        while (static::where('external_id', $randomId)->exists());

        return $randomId;
    }

    protected $fillable=[
        'invoice_id' ,
        'operation_number' ,
        'external_id' ,
        'status'
    ];
}
