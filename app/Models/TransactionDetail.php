<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable=['id','transaction_id', 'product_id','quantity','amount'];

    public function transaction()
    {
        return $this->belongTo(Transaction::class, 'transaction_id', 'id');
    }

    public $incrementing = false;
}
