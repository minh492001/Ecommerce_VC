<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        ];
    }

    static public function getAdmin()
    {
        return User::select('users.*')
            ->where('is_admin', '=', 1)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    static public function getCustomer()
    {
        $return = User::select('users.*');
        if (!empty(Request::get('id'))) {
            $return = User::where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('name'))) {
            $return = self::where('name', 'like', '%'.Request::get('name').'%');
        }
        if (!empty(Request::get('email'))) {
            $return = self::where('email', 'like', '%'.Request::get('email').'%');
        }
        if (!empty(Request::get('from_date')) && empty(Request::get('to_date'))) {
            $return = User::whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (empty(Request::get('from_date')) && !empty(Request::get('to_date'))) {
            $return = User::whereDate('created_at', '<=', Request::get('to_date'));
        }
        if (!empty(Request::get('from_date')) && !empty(Request::get('to_date'))) {
            $return = User::whereDate('created_at', '>=', Request::get('from_date'))
                ->whereDate('created_at', '<=', Request::get('to_date'));
        }
        $return = $return->where('is_admin', '=', 0)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'asc')
            ->paginate(10);
        return $return;
    }

    static public function getSingle($id)
    {
        return User::find($id);
    }

    static public function checkEmail($email)
    {
        return User::select('users.*')
            ->where('email', '=', $email)
            ->first();
    }
}
