<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'fam',
        // 'im',
        // 'otch' ,
        'login',
        'email',
        'person_id',
        'password',
    ];

    protected $appends = [
        'fam',
        'im',
        'otch',
        'sex',
        'birth_date',
        'profile_photo_url',
    ];


    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($this->fam . ' ' . $this->im).'&color=7F9CF5&background=EBF4FF';
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];
    
    /**
    * Get the status that owns the Flight
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function getFamAttribute() {
        return $this->person()->first()->fam;
    }
    public function getImAttribute() {
        return $this->person()->first()->im;
    }
    public function getOtchAttribute() {
        return $this->person()->first()->otch;
    }
    public function getSexAttribute() {
        return $this->person()->first()->sex;
    }
    public function getBirthDateAttribute() {
        return $this->person()->first()->birth_date;
    }
}
