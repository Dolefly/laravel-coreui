<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTable extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'dob',
        'guardianName',
        'gender',
        'iDnumber',
        'phone',
        'insurer_id',
        'code',
        'county',
        'residence'
    ];
}
