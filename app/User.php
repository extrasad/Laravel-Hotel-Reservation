<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Sistemas de roles
     */

    public function hasRoles(array $roles)
    {
        foreach ($roles as $key => $role) { 
            foreach ($this->roles as $userRole) {
                if($userRole->name === $role)
                {
                    return true;
                }
            }
            # code...
        }
        return false;
    }

    public function isRecepcionista()
    {
        return $this->hasRoles(['Recepcionista']);
    }

}
