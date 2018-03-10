<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model {
    protected $table = 'student';

    protected $fillable = ['name', 'age', 'sex', 'class'];

    public $timestamps = false;

    public function getGrade($ind = null) {
        $ind = intval($ind / 100);
//        echo "nianji".$ind."end";exit;
        $arr = [
            10 => '高一',
            11 => '高二',
            12 => '高三',

        ];

        if ($ind !== null) {
            return array_key_exists($ind, $arr) ? $arr[$ind] : 'null';
        }

        return 'null';
    }
}
?>