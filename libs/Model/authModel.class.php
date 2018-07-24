<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 15:04
 */

class authModel{

    private $auth = ""; // 当前管理员信息

    public function __construct(){
        if (isset($_SESSION['auth']) && (!empty($_SESSION['auth']))){
            $this->auth = $_SESSION['auth'];
        }
    }

    public function loginsubmit(){  // 进行验证的一系列逻辑
        if (empty($_POST['username']) || empty($_POST['password'])){
            return false;
        }
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);
        if ($this->auth = $this->checkuser($username,$password)){
            $_SESSION['auth'] = $this->auth;
            return true;
        }else{
            return false;
        }
    }

    private function checkuser($username,$password){
        $adminObj = M('admin');
        $auth = $adminObj->findOne_by_username($username);
        if ((!empty($auth)) && $auth['password'] == $password){
            return $auth;
        }else{
            return false;
        }
    }

    public function getAuth(){
        return $this->auth;
    }

    public function logout(){
        unset($_SESSION['auth']);
        $this->auth = '';
    }
}
