<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticableInterface;

class Buyer extends Authenticatable 
{
    use HasApiTokens, Notifiable;

    protected $guard='buyer';

    protected $fillable=['name','email','password','deposit_amount','access_token'];
}
