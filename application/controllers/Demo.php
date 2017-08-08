<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     * 컨트롤러에서 모델을 호출해서 가져옵니다.
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('demo_model');
        $this->load->helper('url');
        //debug용 함수입니다 해당 컨트롤러 클래스내에서 debug=inno로 잡게되면나올수있게 처리해두었습니다.
        if($this->input->get('debug')=='inno'){
            $this->output->enable_profiler();
        }
    }

    public function index(){
        redirect('/demo/tablelist/');
        #$returns=$this->demo_model->getData();
        #$this->load->view('/demo/demo',array('returns'=>$returns));
    }
    /*테이블 리스트 뷰*/
    public function tablelist(){
        $datas=$this->demo_model->getTables();
        $this->load->view('/demo/tablelist',array('datas'=>$datas));

    }
    public function tableview($tableName){
        $return=$this->demo_model->getTablesInfo($tableName);
        $this->load->view('/demo/tableview',array('return'=>$return));
    }
    public function pdo(){
        $return = $this->demo_model->pdoDemo();
        $this->load->view('/demo/pdoview',array('return'=>$return));
    }
    public function randomInput(){
        $data=$this->db->query("select buildingidx,sum(perct),count(*) as cnt from permissions group by buildingidx having sum(perct)!=100 order by buildingidx asc   limit 1");
        if(!count($data->result())){
            echo "stop";
            return;
        }
        $buildIdx=$data->result()[0]->buildingidx;
        $randomsArray=$this->RandomPer($data->result()[0]->cnt);
        $datas=$this->db->query("select * from permissions where buildingidx='$buildIdx'");
        foreach($datas->result() as $k=>$v){
            $this->db->update('permissions',array('perct'=>$randomsArray[$k]),"idx='$v->idx'");
        }
        echo $buildIdx."<br>";
        echo "<script>window.location.reload()</script>";


    }
    function randomhan($max){
        $return="";
        for($i=0;$i<$max;$i++) {
            $return .= $this->num_to_han(mt_rand(44032, 55203));
        }
        return $return;
    }
    function RandomPer($x){

        $temp[] = 0;
        for($i=1; $i<$x; $i++) {
            $new = mt_rand(1, 99);
            if($i<98) {
                while(in_array($new,$temp)) {
                    $new = mt_rand(1, 99);
                }
            }
            $temp[] = $new;
        }
        $temp[] = 100;
        sort($temp);
        $percentages = [];
        for($i=1; $i<count($temp); $i++) {
            $percentages[] = $temp[$i] - $temp[$i-1];
        }

        return $percentages;
    }

    function han_to_num($str){
        return substr(mb_convert_encoding($str,'HTML-ENTITIES','UTF-8'),2,-1);
    }
    function num_to_han($num){
        return mb_convert_encoding('&#'.$num.';','UTF-8','HTML-ENTITIES');
    }



}
