<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 11:37
 */


header("Content-type:text/html;charset=utf-8");
session_start();
require_once 'config.php';
require_once 'framework/pc.php';
PC::run($config);

