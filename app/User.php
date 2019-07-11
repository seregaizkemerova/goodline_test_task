<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class User extends Authenticatable
{
    use Notifiable;

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
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public static function createAuthTablesIfNotExist() {
    	if (!Schema::hasTable('users')) {
    		Schema::create('users', function (Blueprint $table) {
	            $table->increments('id');
	            $table->string('name', 255);
	            $table->string('email', 190)->unique();
	            $table->timestamp('email_verified_at')->nullable();
	            $table->string('password', 255);
	            $table->rememberToken();
	            $table->timestamps();
    		});
    	}
    	
    	if (!Schema::hasTable('password_resets')) {
	        Schema::create('password_resets', function (Blueprint $table) {
	            $table->string('email', 190)->index();
	            $table->string('token', 190)->index();
	            $table->timestamp('created_at');
	        });
    	}
    } 
}
