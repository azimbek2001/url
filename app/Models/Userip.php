<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userip extends Model
{
    use HasFactory;
     protected $fillable = [
     	'ip',
     	'count',
     	'links_id'
     ];

    
}
