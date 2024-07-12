<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'uid_id'
    ];


    public function rfid()
    {
        return $this->belongsTo(RFID::class, 'uid_id', 'user_id');
    }

    public function attandencesheets()
    {
        return $this->hasMany(Attandencesheet::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class, 'enrollment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
