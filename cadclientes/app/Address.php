<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street', 'neighborhood', 'number'
    ];

    protected $table = 'addresses';

    public function customer()
    {
        return $this->belongsToMany(Customer::class, 'addresses_customers');
    }
}
