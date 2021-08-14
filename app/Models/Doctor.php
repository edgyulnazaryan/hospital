<?php
use App\Models\Patient;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = 
    [
        'name',
        'surname',
        'phone',
        'city',
        'profession',
        'email',
        'date_of_birth',
        'passport',
        'gender',
    ];
}
