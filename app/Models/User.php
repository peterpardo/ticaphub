<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'student_number',
        'password',
        'ticap_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function userProgram() {
        return $this->hasOne(UserProgram::class, 'user_id', 'id');
    }

    public function candidate() {
        return $this->hasOne(Candidate::class, 'user_id', 'id');
    }

    public function votes() {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }

    public function userGroup() {
        return $this->hasOne(UserGroup::class, 'user_id', 'id');
    }

    public function userSchool() {
        return $this->hasOne(UserSchool::class, 'user_id', 'id');
    }

    public function lists() {
        return $this->hasMany(TaskList::class, 'user_id', 'id');
    }
}
