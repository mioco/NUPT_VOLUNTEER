<?php
namespace User\Controller;
use Common\Controller\MemberbaseController;
class RecordController extends MemberbaseController{
	function index(){
		R('Indexadmin/recordInfo', array(sp_get_current_userid()));
        $this -> display(':record');
	}
}
?>