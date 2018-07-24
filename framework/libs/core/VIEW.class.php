<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 11:03
 */

class VIEW{

    public static $view;

    /**
     * 根据配置初始化模板引擎对象
     * @param $viewtype
     * @param $config
     */
    public static function init($viewtype,$config){
        self::$view = new $viewtype;
        foreach ($config as $key=>$value){
            self::$view->$key = $value;
        }
    }

    /**
     * 封装数据
     * @param $data
     */
    public static function assign($data){
        foreach ($data as $key=>$value){
            self::$view->assign($key,$value);
        }
    }

    /**
     * 展示视图
     * @param $template
     */
    public static function display($template){
        self::$view->display($template);
    }
}