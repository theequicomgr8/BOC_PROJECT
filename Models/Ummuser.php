<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ummuser extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $connection = 'sqlsrv';
// protected $connection = 'mysql';
protected $table = 'BOC$UMM User';

    protected $fillable = [
       'timestamp',
      'User Type',
      'User ID',
      'User Name',
      'Gender',
      'Password',
      'Email',
      'Mobile No_',
      'Employee Code',
      'Active',
      'Last Updated By',
      'Last Update Date Time'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password',
        //'remember_token',
    ];
    public $timestamps=false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
