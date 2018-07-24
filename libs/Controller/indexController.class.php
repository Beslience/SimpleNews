<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 18:30
 */

class indexController{

    public function index(){
        $this->showAbout();
        $newObj = M('news');
        $data = $newObj->get_news_list();
        VIEW::assign(array('data'=>$data));
        // VIEW::display('index/index.html');
    }

    public function newsShow(){
        $this->showAbout();
        $data = $newObj = M('news')->getNewsInfo(intval($_GET['id']));
        VIEW::assign(array('data'=>$data));
        // VIEW::display('index/show.html');
    }

    private function showAbout(){
        $data = M('about')->aboutInfo();
        VIEW::assign(array('about'=>$data));
    }
}