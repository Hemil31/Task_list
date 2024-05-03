<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory, HasUlids;
    public $table = "articles_table_ulid";
    protected $guarded = [];
    // protected $dateFormat = 'Y-m-d H:i:s'; // Set the desired format here

    // /**
    //  * The attributes that should be mutated to dates.
    //  *
    //  * @var array
    //  */
    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    //     // Add any other timestamp fields you have
    // ];

   

}


