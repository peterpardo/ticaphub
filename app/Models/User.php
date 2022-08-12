<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        'password',
        'ticap_id',
        'email_verified',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userElection() {
        return $this->hasOne(UserElection::class, 'user_id', 'id');
    }
    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
    public function school() {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
    public function userSpecialization() {
        return $this->hasOne(UserSpecialization::class, 'user_id', 'id');
    }
    public function candidate() {
        return $this->hasOne(Candidate::class, 'user_id', 'id');
    }
    public function officer() {
        return $this->hasOne(Officer::class, 'user_id', 'id');
    }
    public function votes() {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }
    public function userGroup() {
        return $this->hasOne(UserGroup::class, 'user_id', 'id');
    }
    public function lists() {
        return $this->hasMany(TaskList::class, 'user_id', 'id');
    }
    public function tasks() {
        return $this->belongsToMany(Task::class, 'user_task', 'user_id', 'task_id')
        ->withPivot('is_read')
        ->withTimestamps();
    }
    public function tasksCreated() {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }
    public function activities() {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }
    public function committee() {
        return $this->hasOne(Committee::class, 'user_id', 'id');
    }
    public function committeeMember() {
        return $this->hasOne(CommitteeMember::class, 'user_id', 'id');
    }
    public function committeeTasks() {
        return $this->belongsToMany(CommitteeTask::class, 'member_task', 'user_id', 'task_id')
            ->withPivot('is_read')
            ->withTimestamps();
    }
    public function specializationPanelist() {
        return $this->hasMany(SpecializationPanelist::class, 'user_id', 'id');
    }
    public function panelistGrades() {
        return $this->hasMany(PanelistGrade::class, 'user_id', 'id');
    }
    public function individualCandidates() {
        return $this->hasMany(IndividualAwardCandidate::class, 'user_id', 'id');
    }
    public function schedules() {
        return $this->belongsToMany(Schedule::class, 'user_schedule', 'user_id', 'schedule_id');
    }

    public function scopeSearch($query, $term) {
        $term  = "%$term%";
        $query->where(function($query) use ($term){
            $query->where(DB::raw("CONCAT(first_name, ' ', middle_name, ' ', last_name)"), 'LIKE', $term)
                ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', $term);
        });
    }

    public function getFirstNameAttribute($value) {
        return ucwords($value);
    }

    public function getMiddleNameAttribute($value) {
        return ucwords($value);
    }

    public function getLastNameAttribute($value) {
        return ucwords($value);
    }

    public function getFullnameAttribute() {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function getStatusAttribute() {
        return $this->email_verified === 'verified' ? 'green' : 'red';
    }

    public function getEmailVerifiedAttribute($value) {
        return $value ? 'verified' : 'not verified';
    }
}
