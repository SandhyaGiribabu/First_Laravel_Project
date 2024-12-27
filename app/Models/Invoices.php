<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    /** @use HasFactory<\Database\Factories\InvoicesFactory> */
    use HasFactory;
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
