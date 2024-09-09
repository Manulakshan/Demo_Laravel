<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    
    use HasFactory;
    
        protected $fillable = [
            'customer_id',
            'title',
            'details',
            'status',
        ];


    
}
