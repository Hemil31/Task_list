<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $table = 'addresses';

    protected $fillable = [
        'type',
        'line_1',
        'city',
        'state',
        'postcode',
    ];
}
