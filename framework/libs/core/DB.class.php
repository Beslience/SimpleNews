<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 10:51
 */
class DB{

    public static $db;

    /**
     * 初始化
     * @param $dbtype
     * @param $config
     */
    public static function init($dbtype,$config){
        self::$db = new $dbtype;
        self::$db->connect($config);
    }

    /**
     * 成功 返回查询结果对象 失败 返回false
     * @param $sql
     * @return mixed
     */
    public static function query($sql){
        return self::$db->query($sql);
    }

    /**
     * 成功 返回查询结果集 失败 返回false
     * @param $sql
     * @return mixed
     */
    public static function findAll($sql){
        $query = self::$db->query($sql);
        return self::$db->findAll($query);
    }

    /**
     * 成功 返回一条查询结果 失败 返回false
     * @param $sql
     * @return mixed
     */
    public static function findOne($sql){
        $query = self::$db->query($sql);
        return self::$db->findOne($query);
    }

    /**
     * 插入
     * @param $table
     * @param $arr
     * @return mixed
     */
    public static function insert($table,$arr){
        return self::$db->insert($table,$arr);
    }

    /**
     * 更新
     * @param $table
     * @param $arr
     * @param $where
     * @return mixed
     */
    public static function update($table,$arr,$where){
        return self::$db->update($table,$arr,$where);
    }

    /**
     * 删除
     * @param $table
     * @param $where
     * @return mixed
     */
    public static function delete($table,$where){
        return self::$db->delete($table,$where);
    }
}