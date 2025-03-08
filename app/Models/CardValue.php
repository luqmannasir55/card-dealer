<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardValue extends Model {
    use HasFactory;
    protected $table = 'card_values';
    protected $fillable = ['value'];
}

