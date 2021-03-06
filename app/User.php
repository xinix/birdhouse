<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Birdhouse;

class User extends Authenticatable
{
    use Notifiable;

    public static function boot()
    {
        parent::boot();

        self::created(function ($user) {
            $user->birdhouses()->create([
                'user_id' => $user->id,
                'name' => 'My birdhouse',
                'slug' => 'my-birdhouse'
            ]);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    public function birdhouses()
    {
        return $this->hasMany(Birdhouse::class)->latest();
    }
}
