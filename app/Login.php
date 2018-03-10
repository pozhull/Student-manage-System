<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model {
    protected $table = 'users';

    protected $fillable = ['username', 'password', 'type', 'class', 'license'];

    public $timestamps = false;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

}
?>