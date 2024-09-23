<?php

namespace VadiksMoniks\PhoneBook\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;
    protected $table = 'phone_numbers';
    protected $fillable = ['person_id', 'phone_number'];
}
