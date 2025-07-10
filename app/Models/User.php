<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'user_name',
        'whatsapp_number',
        'phone_number',
        'address',
        'password',
        'email',
        'img_name'
    ];

    protected $hidden = [
        'password',
    ];
}
// app/Http/Requests/RegistrationRequest.php
?>