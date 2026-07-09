<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
protected $fillable = ['name', 'gender', 'ratings', 'recommendation', 'overall_rating', 'notes'];
}
