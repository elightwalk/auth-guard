<?php

namespace Elightwalk\AuthGuard\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var string
     */

    public $table = 'password_resets';

    protected $primaryKey = "id";

    protected $fillable = [
        'email', 'token',
    ];

    public $timestamps = true;

    public function scopeToken($query, $value)
    {
        return $query->where('token', $value);
    }

    public function scopeEmail($query, $value)
    {
        return $query->where('email', $value);
    }
}
