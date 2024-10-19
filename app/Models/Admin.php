<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    protected $table = 'Admin';
    protected $primaryKey = 'ad_ID';
    public $timestamps = false;
    protected $fillable = [
        'ad_Fname',
        'ad_Lname',
        'ad_Email',
        'password',
        'ad_Phone',
    ];

    public function getFullNameAttribute()
    {
        return $this->ad_Fname . ' '. $this->ad_Lname;
    }
}







