<?php
/**
 * Created by PhpStorm.
 * User: inno_03
 * Date: 2017-04-24
 * Time: 오후 2:29
 * 데모모델 만들어뒀습니다.
 */
class Demo_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->pdo=$this->load->database('pdo',true);
    }
    function getData(){
        $return = $this->db->query('SELECT * FROM test')->result();
        return $return;
    }
    function getTables(){
        $return=$this->db->query("show tables")->result();
        return $return;
    }
    function getTablesInfo($tableName){
        $sql1="select TABLE_NAME,TABLE_COMMENT from information_schema.`TABLES` where table_name='$tableName'";
        $sql2="select COLUMN_NAME,COLUMN_TYPE,COLUMN_COMMENT from information_schema.`COLUMNS` where table_name='$tableName'";


        $return=array(
            'basic'=>pos($this->db->query($sql1)->result()),
            'infos'=>$this->db->query($sql2)->result(),
        );
        return $return;
    }
    function pdoDemo(){
        $sql = "SELECT * FROM users WHERE userid IN ? AND userid = ? ";
        $query=$this->pdo->query($sql, array(array('vgbgbg@naver.com', 'vgbgbg@gmail.com'), 'vgbgbg@naver.com'));
        $return=array(
            "pdoSql"=>$sql,
            "sqlString"=>$query->result_id->queryString,
            "datas"=>$query->result(),
        );
        return $return;
    }

}