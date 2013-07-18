<?php
if( !defined('IN') ) die('bad request');
include_once( AROOT . 'controller'.DS.'app.class.php' );

class indexController extends appController
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$data['title'] = $data['top_title'] = '新闻首页';
              $page = file_get_contents("http://m.cnbeta.com");
              preg_match_all('#<div class="list"><a href="/view\.htm\?id=(\d+?)">(.*)</a></div>#iUs',$page,$news,2);
              foreach($news as $k=>$v) {
                $news[$k]['url'] = "/?a=view&id=".$v[1];
                $news[$k]['title'] = $v[2];
              }
              $data['news'] = $news;
              $data['js'] = array("index.js");
		render( $data,'web','index' );
	}
    
        function view() {
            $id = intval(v('id'));
            if($id) {
                $news_url = "http://m.cnbeta.com/view.htm?id=".$id;
               $page = file_get_contents($news_url);
               preg_match('#<div class="content"><p>.*</p></div>#iUs',$page,$content);
               $data['content'] = $content[0];
               render($data,"ajax","view");
            }else {
                info_page("错误页面");
            }
        }
}	