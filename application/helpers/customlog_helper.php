<?php
/**
 * Created by PhpStorm.
 * User: cfantasia
 * Date: 2017-07-06
 * Time: 오후 5:38
 */
function createlog($obj,$msg="log"){
	$userInfo=$obj->session->get_userdata();
	$obj->db->set('member_id', isset($userInfo['idx']) ? $userInfo['email'] : 'nobody');
	$obj->db->set('msg', $msg);
	$obj->db->insert('logs');
	$result = $obj->db->insert_id();
	return $result;
}