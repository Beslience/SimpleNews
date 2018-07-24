<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/19
 * Time: 16:13
 */

/**
 * 实例化控制层对象
 * @param $name
 * @param $method
 * @return mixed
 */
function C($name,$method){
    require_once 'libs/Controller/'.$name.'Controller.class.php';
    // eval把字符串转换成可以执行的语句
    //eval('$obj = new '.$name.'Controller(); $obj->'.$method.'();');
    $controller = $name.'Controller';
    $obj = new $controller();
    $obj->$method();
    return $obj;
}

/**
 * 实例化模型层对象
 * @param $name
 * @return mixed
 */
function M($name){
    require_once 'libs/Model/'.$name.'Model.class.php';
    $model = $name.'Model';
    $obj = new $model();
    return $obj;
}

/**
 * 实例化视图层对象
 * @param $name
 * @return mixed
 */
function V($name){
    require_once 'libs/View/'.$name.'View.class.php';
    $view = $name. 'View';
    $obj = new $view();
    return $obj;
}

/**
 * 对str进行转义
 * @param $str
 * @return string
 */
function daddslashes($str){
    return (!get_magic_quotes_gpc())?addslashes($str):$str;
}
