<?php
namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ABCCirculation extends Model
{
    use HasFactory;

    protected $table = 'BOC$ABC Circulations';
    protected $guarded = array();
    public $timestamps  = false;
}
