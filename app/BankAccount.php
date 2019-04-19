<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    // Table Name
    protected $table = 'bank_account';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
   public $timestamps = false ;


}
