<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class familymember extends Model
{
    use HasFactory;

    protected  $guarded = [];

    public function familycard() {
        return $this->belongsTo(familycard::class);
    }
}
