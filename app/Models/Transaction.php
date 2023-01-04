<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'customer', 'address', 'total_amount'];
    public $incrementing = false;

    public function details()
    {
        return $this->hasMany(transactionDetail::class);
    }

    //public $incrementing - false;
}