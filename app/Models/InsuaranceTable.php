<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuaranceTable extends Model
{
    use HasFactory;
    protected $fillable=[
        'code',
        'name',
        'contact_name',
        'phone',
    ];
}
