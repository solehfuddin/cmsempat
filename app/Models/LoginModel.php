<?php namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model {
    protected $table = 'tbl_user';

    public function login($key){
        return $this->where(['tbl_user.email' => $key])
                    ->find();
    }
}