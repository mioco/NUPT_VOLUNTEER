<?php
namespace Recruit\Controller;
use Common\Controller\HomeBaseController;
header('Content-type:text/html; charset=utf-8');
class RecruitController extends HomeBaseController{
	
	protected $recruit_model;
	protected $posts_model;
	protected $term_relationships;
	
	function _initialize() {
		parent::_initialize();
		$this->recruit_model=D("Common/Recruit");
		$this->posts_model=D("Common/posts");
		$this->term_relationships=D('Common/term_relationships');
		$this->terms_model = D('Common/terms');
	}
	
	function index(){
		// $this->listIndex();
        $field = "po.id,object_id,post_title,post_address,post_date,ac_start,ac_end,smeta,post_hits,post_like";
        $posts = $this->posts_model
        ->alias('po')
        ->join(C('DB_PREFIX').'term_relationships tr on po.id = tr.object_id')
        ->join(C('DB_PREFIX').'terms t on tr.term_id = t.term_id')
        ->field($field) -> where("t.parent=3 and tr.status=1") -> order('post_modified desc')->select();
        $terms = $this->terms_model->where('parent=3')->select();
        $this->assign('posts', $posts);
        $this->assign('terms', $terms);
		$this->display(":index");
	}

	function listIndex() {
        extract($_GET);
        if ($_GET) {
            $where['cycle_type'] = array('like', '%'.$cycle_type.'%');
	        $where['cycle'] = array('like', '%'.$cycle.'%');
	        $where['t.term_id'] = array('like', '%'.$term_id.'%');
	        $where['active_status'] = array('like', '%'.$active_status.'%');
        }
        $where['parent'] = 3;
        if (isset($order)) {
            switch ($order) {
            case 'time':
                $order = 'post_modified desc';
                break;
            case 'duration':
                $order = 'duration desc';
                break;
            case 'hot':
                $order = 'post_hits desc,comment_count desc';
                break;
            default:
                $this->error('请求错误');
                break;
            }
        }
        $field = "po.id,object_id,post_title,post_address,post_date,ac_start,ac_end,smeta,post_hits,post_like,duration";
        $posts = $this->posts_model
        ->alias('po')
        ->join(C('DB_PREFIX').'term_relationships tr on po.id = tr.object_id')
        ->join(C('DB_PREFIX').'terms t on tr.term_id = t.term_id')
        ->field($field) -> where($where) -> order($order) -> select();
        $this->assign('posts',$posts);
        $this->display('/list');
    }
}