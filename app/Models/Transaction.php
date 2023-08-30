<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_no',
        'bank_account_id',
        'type',
        'amount'
    ];

    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class);
    }

}
