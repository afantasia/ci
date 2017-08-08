<?php
/**
 * Created by PhpStorm.
 * User: cfantasia
 * Date: 2017-06-21
 * Time: 오전 11:03
 */
class api_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->pdo = $this->load->database('pdo', true);
	}



	/**
	 * @param $idx
	 * @return array
	 * 회원정보를 idx로 리턴해서 가져옵니다.
	 */
	function getData($idx){
		$sql = "SELECT * FROM apilist WHERE idx = ? ";
		$query=$this->pdo->query($sql, array($idx));
		$return=array(
			"pdoSql"=>$sql,
			"sqlString"=>$query->result_id->queryString,
			"data"=>$query->row_array(),
		);
		return $return;
	}
	function allData(){
		$sql = "SELECT * FROM apilist WHERE 1=1 and delete_flag='N'";
		$query=$this->pdo->query($sql);
		$return=array(
			"pdoSql"=>$sql,
			"sqlString"=>$query->result_id->queryString,
			"data"=>$query->result_array(),
		);
		return $return;
	}
	function insertData($params){
		$this->db->set('name', $params['name']);
		$this->db->set('url', $params['url']);
		$this->db->set('params', $params['params']);
		$this->db->set('method', $params['method']);
		$this->db->insert('apilist');
		$result = $this->db->insert_id();
		return $result;
	}
	function UpdateData($params){
		$data=[
			'name'=>$params['name'],
			'url'=>$params['url'],
			'method'=>$params['method'],
			'params'=>$params['params'],
		];
		$return=$this->db->update('apilist', $data, array('idx' => $params['idx']));
		return  $return;
	}
}