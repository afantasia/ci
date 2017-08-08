<?php
/**
 * Created by PhpStorm.
 * User: cfantasia
 * Date: 2017-06-21
 * Time: 오전 11:03
 */
class faq_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->pdo = $this->load->database('pdo', true);
	}
	function Lists($params){
		$this->db->select('*');
		//$this->db->from('users');
		if(isset($params['pageno'])){
			$pageno=0;
		}

		if(isset($params['category'])){
			$this->db->where('category', $params['category']);
		}
		if(isset($params['question'])){
			$this->db->like('question', $params['question']);
		}
		if(isset($params['content'])){

			$this->db->like('content', $params['content']);
		}

		$this->db->order_by('idx','desc');
		$query = $this->db->get('faq', 1, 1);
		$return = $query->result_array();
		return $return;

	}
	/**
	 * @param $params
	 * @return mixed
	 */
	function insertData($params){
		$this->db->set('category', $params['category']);
		$this->db->set('question', $params['question']);
		$this->db->set('content', $params['content']);
		$this->db->insert('faq');
		$result = $this->db->insert_id();
		return $result;
	}

	/**
	 * @param $params
	 * @return mixed
	 */
	function UpdateData($params){
		$data=[
			'category'=>$params['category'],
			'question'=>$params['question'],
			'content'=>$params['content'],
		];
		$return=$this->db->update('faq', $data, array('idx' => $params['idx']));
		return  $return;
	}

	public function view($idx){
		$sql = "SELECT * FROM faq WHERE idx = ? ";
		$query=$this->pdo->query($sql, array($idx));
		$return=array(
			"pdoSql"=>$sql,
			"sqlString"=>$query->result_id->queryString,
			"data"=>$query->row_array(),
		);
		return $return;
	}

}