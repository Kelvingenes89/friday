<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class record extends Model
{
    use HasFactory;
    protected $table = 'records';

    protected $fillable = [
        'ratiba_id',
        'enrollment_id',
    ];

    

    /**
     * Get the enrollment associated with the attendance sheet.
     */
    public function clock()
    {
        return $this->belongsTo(Clock::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id');
    }

    public function ratiba()
    {
        return $this->belongsTo(Ratiba::class, 'ratiba_id');
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    
    
    
} 
