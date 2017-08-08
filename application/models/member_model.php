<?php
/**
 * Created by PhpStorm.
 * User: inno_03
 * Date: 2017-04-24
 * Time: 오후 2:29
 * 데모모델 만들어뒀습니다.
 */
class member_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->pdo=$this->load->database('pdo',true);
		$this->mainTable="members";
	}

	/**
	 * @param $limit
	 * @param $offset
	 * @param $key
	 * @param $keyword
	 * @return mixed
	 * 페이지 리스트를 쪼개어 배열로 리턴해줍니다.
	 */
	function get_list($limit, $offset, $key, $keyword){
		$this->db->select('*');
		if( $key && $keyword ){
			$this->db->like($key, $keyword);
		}
		$this->db->order_by('idx','desc');
		$query = $this->db->get($this->mainTable, $limit, $offset);
		$return = $query->result_array();
		return $return; 
	}

	/**
	 * @param $key
	 * @param $keyword
	 * @return mixed
	 * 검색된 쿼리의 갯수를 가져옵니다.
	 */
	function get_list_count($key, $keyword){
		$this->db->select('count(*) as cnt');
		//$this->db->from('users');
		if( $key && $keyword ){
			$this->db->like($key, $keyword);
		}
		//$this->db->order_by('idx','desc');
		$query = $this->db->get($this->mainTable);
		$rtn = $query->row_array();
		$return = $rtn['cnt'];
		return $return; 
	}

	/**
	 * @param $idx
	 * @return array
	 * 회원정보를 idx로 리턴해서 가져옵니다.
	 */
	function getData($idx){
		$sql = "SELECT * FROM ".$this->mainTable." WHERE idx = ? ";
		$query=$this->pdo->query($sql, array($idx));

		$return=array(
			"pdoSql"=>$sql,
			"sqlString"=>$query->result_id->queryString,
			"data"=>$query->result(),
		);
		return $return;
	}

	/**
	 * @param $userid
	 * @return array
	 * 회원정보를 email주소로 해서 가져옵니다
	 */
	function getDataUserID($userid){
		$sql = "SELECT * FROM ".$this->mainTable." WHERE email = ? ";
		$query=$this->pdo->query($sql, array($userid));
		$return=array(
			"pdoSql"=>$sql,
			"sqlString"=>$query->result_id->queryString,
			"data"=>$query->result_array(),
		);
		return $return;
	}

	/**
	 * @param $params
	 * @return int
	 * 회원테이블의 insert 이후 last_insert_id 를 리턴해줍니다.
	 */
	function RegistMember($params){
		$this->db->set('email', $params['email']);
		$this->db->set('name', $params['name']);
		$this->db->set('password', $params['password']);
		$this->db->set('id', $params['id']);
		$this->db->insert($this->mainTable);
		$result = $this->db->insert_id();
		return $result;
	}

	/**
	 * @param $params
	 * @return string
	 * 아이디 찾기 모델러
	 */
	function findId($params){
		$sql = "SELECT id FROM ".$this->mainTable." WHERE email = ? and name = ?";
		$query=$this->pdo->query($sql, array($params['email'],$params['name']));
		$r=$query->row_array();
		if(isset($r['id'])){
			$r['id']=substr($r['id'],0,-3)."***";
		}
		return $r['id'];
	}

	/**
	 * @param $params
	 * @return bool
	 * 임시 패스워드로 이메일로 아이디를 전송해줍니다.
	 */
	function findPw($params){
		$sql = "SELECT email FROM ".$this->mainTable." WHERE email = ? and name = ? and id = ?";
		$query=$this->pdo->query($sql, array($params['email'],$params['name'],$params['id']));

		$r=$query->row_array();
		if($r['email']){

			$maxstr=mt_rand(10,15);
			$tmpPass="";
			for($i=0;$i<$maxstr;$i++){
				$tmpPass.=chr(mt_rand(97,122));
			}
			$result=['len'=>strlen($tmpPass),'str'=>$tmpPass,'maxstr'=>$maxstr];
		}else{
			$result=false;
		}
		return $result;
	}

}