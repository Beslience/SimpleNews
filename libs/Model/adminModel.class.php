<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 14:59
 */

class adminModel{

    public $_table = 'admin';

    // 取用户信息
    function findOne_by_username($username){
        $sql = 'select * from '.$this->_table.' where username = "'.$username.'"';
        return DB::findOne($sql);

    }

}