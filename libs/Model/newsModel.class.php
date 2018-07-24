<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/20
 * Time: 16:08
 */
class newsModel{

    public $_tables = 'news';

    public function count(){
        $sql = "select count(*) from ".$this->_tables;
        return DB::findOne($sql);
    }

    public function getNewsInfo($id){
        if (empty($id)){
            return array();
        }else{
            $id = intval($id);
            $sql = "select * from ".$this->_tables.' where id = '.$id;
            return DB::findOne($sql);
        }
    }

    public function newsSubmit($data){
        $title = null;
        $content = null;
        $author = null;
        $from = null;
        extract($data);
        if (empty($title) || empty($content)){
            return 0;
        }
        $title = addslashes($title);
        $content = addslashes($content);
        $author = addslashes($author);
        $from = addslashes($from);
        $data = array(
            'title'=>$title,
            'content'=>$content,
            'author'=>$author,
            'from'=>$from,
            'dateline'=>time()
        );
        if ($_POST['id']!=''){
            DB::update($this->_tables,$data,'id ='.$_POST['id']);
            return 2;
        }else{
            DB::insert($this->_tables,$data);
            return 1;
        }
    }

    public function findAll_orderby_dateline(){
        $sql = 'select * from '.$this->_tables.' order by dateline desc';
        return DB::findAll($sql);
    }

    public function delete_by_id($id){
        return DB::delete($this->_tables,'id = '.$id);
    }

    public function get_news_list(){
        $data = $this->findAll_orderby_dateline();
        foreach ($data as $key=>$value){
            $data[$key]['content'] = mb_substr(strip_tags($data[$key]['content']),0,200);
            $data[$key]['dateline'] = date("Y-m-d H:i:s",$data[$key]['dateline']);
        }
        return $data;
    }

}