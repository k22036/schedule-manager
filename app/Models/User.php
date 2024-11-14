<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Fetch all users
     *
     * @return array<string>
     */
    public function fetchAllUsers(): array
    {
        return User::all()->toArray();
    }

    /**
     * Fetch all users except me
     *
     * @param int $id
     * @return array<string>
     */
    public function fetchAllUsersExceptMe($id): array
    {
        return User::where('id', '!=', $id)->get()->toArray();
    }

    /**
     * Fetch user by hashed user_id
     *
     * @param string $target
     * @return array<string>
     */
    public function fetchUser($target): array
    {
        $users = User::all()->toArray();
        foreach ($users as $user) {
            if (hash('sha256', $user['user_id']) === $target) {
                return $user;
            }
        }
        throw new \Exception('User not found');
    }
}
