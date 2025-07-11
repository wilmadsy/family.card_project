<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class familycard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function familymember() {
        return $this->hasMany(familymember::class);
    }
}
