<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $primaryKey = '_id';
    protected $guarded = ['_id'];
}