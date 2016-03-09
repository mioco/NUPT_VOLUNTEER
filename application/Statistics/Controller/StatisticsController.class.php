<?php
namespace Statistics\Controller;
use Common\Controller\AdminbaseController;
class StatisticsController extends AdminbaseController{
	function index() {
		$post = M('Posts');
		$user = M('Users');
		$count['post'] = $post->count();
		$count['user'] = $user->count();
		$user = $user->select();
		$count['duration'] = 0;
		foreach ($user as &$u) {
			$count['duration'] += $u['duration'];
		}
		var_dump($count);
		$this->assign('count',$count);
		$this->display('/index');
	}
}