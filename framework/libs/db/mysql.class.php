<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 10:00
 */


class Mysql{

    private $con = null;

    /**
     * 报错函数
     * @param $error
     */
    function err($error){
        die("对不起，您的操作有误，错误原因为：".$error);    //  die有两种作用 输出 和 终止 相当于 echo和exit 的组合
    }

    /**
     * 连接数据库
     * @param $config
     */
    function connect($config){
        $dbhost = null;
        $dbuser = null;
        $dbpsw = null;
        $dbname = null;
        $dbcharset = null;
        // 从数组中将变量导入到当前的符号表
        extract($config);
        if (!($this->con = mysqli_connect($dbhost,$dbuser,$dbpsw))){
            $this->err(mysqli_error($this->con));
        }
        if (!mysqli_select_db($this->con,$dbname)){
            $this->err(mysqli_error($this->con));
        }
        mysqli_query($this->con,"set names ".$dbcharset);
    }


    /**
     * 执行sql语句
     * @param $sql
     * @return bool|mysqli_result
     */
    function query($sql){
        if (!($query = mysqli_query($this->con,$sql))){
            $this->err($sql."<br />".mysqli_error($this->con));
        }else{
            return $query;
        }
    }

    /**
     * 返回所有查询结果
     * @param $query
     * @return string
     */
    function findAll($query){
        while ($rs = mysqli_fetch_array($query,MYSQLI_ASSOC)){
            $list[] = $rs;
        }
        return isset($list)?$list:"";
    }

    /**
     * 返回单一查询结果
     * @param $query
     * @return array|null
     */
    function findOne($query){
        return mysqli_fetch_array($query,MYSQLI_ASSOC);
    }

    /**
     * 插入
     * @param $table
     * @param $arr
     * @return int|string
     */
    function insert($table,$arr){
        foreach ($arr as $key=>$value){
            $value = mysqli_real_escape_string($this->con,$value);
            $keyArr[] = '`'.$key.'`';
            $valueArr[] = "'".$value."'";
        }
        $keys = implode(',',$keyArr);
        $values = implode(',',$valueArr);
        $sql = "insert into {$table}({$keys}) values({$values})";
        $this->query($sql);
        return mysqli_insert_id($this->con);
    }

    /**
     * 更新
     * @param $table
     * @param $arr
     * @param $where
     */
    function update($table,$arr,$where){
        foreach ($arr as $key=>$value){
            $value = mysqli_real_escape_string($this->con,$value);
            $keyAndVauleArr[] = "`".$key."`='".$value."'";
        }
        $keyAndVaules = implode(",",$keyAndVauleArr);
        $sql = "update {$table} set {$keyAndVaules} where ".$where;
        $this->query($sql);
    }

    /**
     * 删除
     * @param $table
     * @param $where
     */
    function delete($table,$where){
        $sql = "delete from {$table} where ".$where;
        $this->query($sql);
    }
}