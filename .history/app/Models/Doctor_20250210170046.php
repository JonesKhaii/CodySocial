<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    use Notifiable, HasFactory;

    protected $table = 'doctors';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'specialization',
        'experience',
        'working_hours',
        'location',
        'phone',
        'email',
        'photo',
        'status',
        'rating',
        'bio',
        'services',
        'workplace',
        'education',
        'consultation_fee',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'working_hours' => 'array',
        'status' => 'boolean',
        'rating' => 'float',
        'consultation_fee' => 'decimal:2',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctorID', 'doctorID');
    }

    public function reviews()
    {
        return $this->hasMany(DoctorReview::class, 'doctorID', 'doctorID');
    }
}
