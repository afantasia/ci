<?php
/**
 * Created by PhpStorm.
 * User: inno_03
 * Date: 2017-04-24
 * Time: 오후 2:29
 * 데모모델 만들어뒀습니다.
 */
class building_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->pdo=$this->load->database('pdo',true);
		$this->mainTable="buildings";
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
		$query = $this->db->get('buildings', $limit, $offset);
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
		if( $key && $keyword ){
			$this->db->like($key, $keyword);
		}
		$query = $this->db->get('buildings');
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
		$sql = "SELECT * FROM buildings WHERE idx = ? ";
		$query=$this->pdo->query($sql, array($idx));

		$return=array(
			"pdoSql"=>$sql,
			"sqlString"=>$query->result_id->queryString,
			"data"=>$query->result(),
		);
		return $return;
	}


}