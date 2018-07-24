<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 14:21
 */

class adminController{

    public $auth = "";

    /**
     * adminController constructor.
     * 每一次进入后台管理功能，都会在构造快先进行判别是否登录
     */
    public function __construct(){
        // 判断当前是否已经登录
        $authObj = M('auth');
        $this->auth = $authObj->getAuth();
        // 如果不是登录页，而且没有登录，就要跳转到登录页
        if (empty($this->auth) && (PC::$method != 'login')){
            $this->showMessage('请在登录后操作!','admin.php?controller=admin&method=login');
        }

    }

    /**
     * 控制登录
     */
    public function login(){
        if ($_POST){
            // 提交处理
            $this->checkLogin();
        }else{
            // 显示登录界面
            VIEW::display('admin/login.html');
        }

    }

    /**
     * 控制显示管理初始化页面
     */
    public function index(){
        $newObj = M('news');
        $newsnum = $newObj->count();
        VIEW::assign(array('newsnum'=>$newsnum['count(*)']));
        VIEW::display('admin/index.html');
    }

    /**
     * 后台登出功能
     */
    public function logout(){
        $authObj = M('auth');
        $authObj->logout();
        $this->showMessage('退出成功!','admin.php?controller=admin&method=login');
    }

    /**
     * 新闻添加和更新
     */
    public function newsadd(){
        // 判断是否有post数据
        if (empty($_POST)){
            // 没有post数据，就显示添加、修改的界面
            if (isset($_GET['id'])){ //是修改界面
                // 读取旧信息,需要传递新闻id
                $data = M('news')->getNewsInfo($_GET['id']);
            }else{
                $data = array();
            }
            VIEW::assign(array('data'=>$data));
            VIEW::display('admin/newsadd.html');
        }else{
            // 添加 修改的处理程序
            $this->newsSubmit();
        }
    }

    /**
     * 展示新闻列表
     */
    public function newslist(){
        $newsObj = M('news');
        $data = $newsObj->findAll_orderby_dateline();
        VIEW::assign(array('data'=>$data));
        VIEW::display('admin/newslist.html');
    }

    /**
     * 新闻删除
     */
    public function newsdel(){
        if (intval($_GET['id'])){
            $newsObj = M('news');
            $newsObj->delete_by_id($_GET['id']);
            $this->showMessage('删除新闻成功','admin.php?controller=admin&method=newslist');
        }
    }


    private function newsSubmit(){
        $newsObj = M('news');
        $result = $newsObj->newsSubmit($_POST);
        if ($result == 0){
            $this->showMessage('操作失败','admin.php?controller=admin&method=newsadd&id='.$_POST['id']);
        }
        if ($result == 1){
            $this->showMessage('添加成功','admin.php?controller=admin&method=newslist');
        }
        if ($result == 2){
            $this->showMessage('修改成功','admin.php?controller=admin&method=newslist');
        }
    }

    /**
     * 验证用户输入的账号密码
     */
    private function checkLogin(){
        $authObj = M('auth');
        if ($authObj->loginsubmit()){
            $this->showMessage('登录成功!','admin.php?controller=admin&method=index');
        }else{
            $this->showMessage('登录失败!','admin.php?controller=admin&method=login');
        }
    }

    /**
     * 弹出提示信息
     * @param $info
     * @param $url
     */
    private function showMessage($info, $url){
        echo "<script>alert('$info');window.location.href='$url'</script>";
        exit;
    }
}
