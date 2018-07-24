<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 11:24
 */

$currentdir = dirname(__FILE__);
include_once $currentdir."/include.list.php";
foreach ($paths as $path){
    include_once $currentdir.'/'.$path;
}
class PC{
    public static $controller;
    public static $method;
    public static $config;

    /**
     * 根据配置初始化具体db对象
     */
    private static function init_db(){
        DB::init('mysql',self::$config['dbconfig']);
    }

    /**
     * 根据配置初始化具体模板引擎对象
     */
    private static function init_view(){
        VIEW::init('Smarty',self::$config['viewconfig']);
    }

    /**
     * 初始化并接收controller
     */
    private static function init_controller(){
        self::$controller = isset($_GET['controller'])?daddslashes($_GET['controller']):'admin';
    }

    /**
     * 初始化并接收method
     */
    private static function init_method(){
        self::$method = isset($_GET['method'])?daddslashes($_GET['method']):'index';
    }

    /**
     * 调用初始化，并实例化和调用具体Controller
     * @param $config
     */
    public static function run($config){
        self::$config = $config;
        self::init_db();
        self::init_view();
        self::init_controller();
        self::init_method();
        C(self::$controller,self::$method);
    }
}