<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examine extends Model
{
    use HasFactory;
    public $table = "examine";
    protected $fillable = ['first_name', 'last_name', 'title'];
}
