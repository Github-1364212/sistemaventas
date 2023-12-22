<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $table = 'attendences';
    protected $fillable = [
        'user_id',
        'attendence',
        'att_date',
        'att_year',
        'edit_date',
        'month',
    ];
}
