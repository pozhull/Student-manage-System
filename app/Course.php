<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    protected $table = 'course';

    protected $fillable = ['coursename', 'coursegrade', 'courseDesc'];

    public $timestamps = false;

}
?>