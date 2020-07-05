<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticableInterface;

class Buyer extends Authenticatable 
{
    use Notifiable;

    protected $guard='buyer';

    protected $fillable=['name','email','password'];
}
