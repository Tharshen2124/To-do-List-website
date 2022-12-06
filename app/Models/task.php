<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
     protected $fillable = ['tasks'];

     //! fixes the error "Call to a member function greaterThan() on string"
     
     //^ to tell Eloquent that it's a date, so that it will convert it to Carbon
     protected $dates = ['created_at', 'updated_at', 'date_of_completion'];
}
