<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venue extends Model
{
    use HasFactory;
    protected $fillable =[
        'venue'
    ];
    public function ratibas()
    {
        return $this->hasMany(Ratiba::class);
    }
}
