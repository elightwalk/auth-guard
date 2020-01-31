<?php

namespace Elightwalk\AuthGuard\Eloquent;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable
{
    //
    use Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var string
     */

    public $table = 'customers';

    protected $primaryKey = "id";

    protected $guard = 'customers';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = true;

    public function scopeEmail($query, $value)
    {
        return $query->where('email', $value);
    }
}
