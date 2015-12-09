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
        $field = "object_id,tr.tid,object_id,post_title,post_address,post_date,ac_start,ac_end,smeta,post_hits,post_like";
        $posts = $this->posts_model
        ->alias('po')
        ->join(C('DB_PREFIX').'term_relationships tr on po.id = tr.object_id')
        ->join(C('DB_PREFIX').'terms t on tr.term_id = t.term_id')
        ->field($field) -> where("t.parent=3 and tr.status=1") -> select();
        $terms = $this->terms_model->where('parent=3')->select();
        $this->assign('posts', $posts);
        $this->assign('terms', $terms);
		$this->display(":index");
	}

	function listIndex() {
		$time_type = $_GET['time_type'];
        $term = $_GET['term'];
        $time_limit = $_GET['time_limit'];
        echo $time_type.','.$term_type.','.$time_limit;
        if ($time_type || $term || $time_limit || $time_status) {        	
	        $where['quality'] = array('like', '%'.$time_limit.'%');
	        $where['t.term_id'] = array('like', '%'.$term.'%');
	        $where['active_status'] = array('like', '%'.$time_status.'%');
            $where['parent'] = 3;
            dump($where);
        }
        $field = "object_id,tr.tid,object_id,post_title,post_address,post_date,ac_start,ac_end,smeta,post_hits,post_like,duration";
        $posts = $this->posts_model
        ->alias('po')
        ->join(C('DB_PREFIX').'term_relationships tr on po.id = tr.object_id')
        ->join(C('DB_PREFIX').'terms t on tr.term_id = t.term_id')
        ->field($field) -> where($where) -> select();
        $status = array("0" => "招募中", "1" => "进行中", "2" => "已结束");
        // $this->assign('posts', $posts);
        foreach($posts as $vo) {
        	$smeta=json_decode($vo["smeta"],true);
        	echo '<div class="post-box">
            <div class="tc-gridbox">
                <div class="header">
                    <div class="item-image">
                        <a href="'.leuu("article/index",array("id"=>$vo["tid"])).'">';
            if (empty($smeta["thumb"])) {
            	echo '<img src="" class="img-responsive" alt="'.$vo['post_title'].'"/>';
            }else{
            	echo '<img src="'.sp_get_asset_upload_path($smeta["thumb"]).'" class="img-responsive img-thumbnail" alt="'.$vo['post_title'].'"/>';
            }
            echo '</a>
                    </div>
                </div>
                <div class="body">
                    <h3><a href="'.leuu("portal/article/index",array("id"=>$vo["tid"])).'">'.$vo['post_title'].'</a></h3>
                    <p>活动地点：'.$vo['post_address'].'</p>
                    <p>活动发起：'.$vo['user_login'].'</p>
                    <div class="timebox">
                        <p>报名截止：</p>
                        <p><div class="time"><div class="pass_time" id="'.$vo['tid'].'" style="width:{$vo.time_width}%"></div></div></p>
                        <p class="residue">'.$status[$vo["active_status"]].'</p>
                    </div>
                </div>
                <div class="footer">
                    <i class="iconfont">&#xe608</i>'.$vo['join_count'].'&nbsp;
                    <i class="iconfont">&#xe610</i>'.$vo['post_hits'].'
                </div>
            </div>
        </div>';
        }
	}
}