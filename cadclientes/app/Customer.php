<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'birthday', 'cpf', 'rg', 'phone'
    ];

    protected $table = 'customers';

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'addresses_customers');
    }
}
