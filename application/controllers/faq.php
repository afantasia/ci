<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * 컨트롤러에서 모델을 호출해서 가져옵니다.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('faq_model');
		//debug용 함수입니다 해당 컨트롤러 클래스내에서 debug=inno로 잡게되면나올수있게 처리해두었습니다.
		if ($this->input->get('debug') == 'inno') {
			$this->output->enable_profiler();
		}
	}

	/**
	 * 리스트를 불러옵니다/
	 */
	public function lists(){
		$param=$this->input->get();
		$datas=$this->faq_model->Lists($param);
		$config['base_url']    = '/'.uri_string();
		$config['prefix'] = "";
		$config['per_page']    = $page_rows;
		$config['total_rows']  = $total_count;
		$config['page_query_string'] = true;
		// style
		$config['full_tag_open']  = "<div id='pagination'>";
		$config['full_tag_close'] = '</div>';
		// 현재 페이지
		$config['cur_tag_open']  = "<span class='current'>";
		$config['cur_tag_close'] = '</span>';
		$CI =& get_instance();
		$CI->load->library('pagination');
		$CI->pagination->initialize($config);
		if(!$datas){
			$return=array('code'=>'0001','msg'=>'잘못된 접근입니다');
			echo RetJson($return);
			return;
		}
		$return=array('code'=>'0000','msg'=>'조회성공','datas'=>$datas);
		echo RetJson($return);
	}

	/**
	 * @param int $idx
	 * /faq/view/$idx
	 */
	public function view($idx=0){
		if($this->input->get('idx') && is_numeric($this->input->get('idx'))){
			$idx=$this->input->get('idx');
		}
		if($idx>0 && is_numeric($idx)){
			$getData=$this->faq_model->view($idx);
			if(is_array($getData['data'])){
				$return=array('code'=>'0000','msg'=>'조회성공','data'=>$getData['data']);
			}else{
				$return=array('code'=>'0001','msg'=>'조회실패!해당 코드가 존재하지 않습니다');
			}
		}else{
			$return=array('code'=>'0001','msg'=>'잘못된 코드입니다.');
		}
		echo RetJson($return);
	}
	/**
	 * 등록
	 * /faq/regist
	 */
	public function regist(){
		$params=$this->input->post();
		if(!count($params) ){
			$return=array('code'=>'0001','msg'=>'잘못된 접근입니다.');
			echo RetJson($return);
			return;
		}
		$validationArr=array(
			'category'=>'분류명을 입력해주세요',
			'question'=>'질문제목을 입력해주세요',
			'content'=>'답변내용을 입력해주세요',
		);
		foreach($validationArr as $k=>$v){
			if(!$params[$k]){
				$return=array('code'=>'0001','msg'=>$v);
				echo RetJson($return);
				return;
			}
		}
		$data=array(
			'category'=>$params['category'],
			'question'=>$params['question'],
			'content'=>$params['content'],
		);
		$ret=$this->faq_model->insertData($data);
		if($ret){
			$return=array('code'=>'0000','msg'=>'등록성공','data'=>$ret);
		}else{
			$return=array('code'=>'0001','msg'=>'등록실패','data'=>$ret);
		}
		echo RetJson($return);

	}
	/**
	 * 수정하기(삭제도 이곳에서 처리할예정입니다.)
	 * /faq/modify
	 */
	public function modify(){
		$params=$this->input->post();
		if(!count($params) ){
			$return=array('code'=>'0001','msg'=>'잘못된 접근입니다.');
			echo RetJson($return);
			return;
		}
		$validationArr=array(
			'category'=>'분류명을 입력해주세요',
			'question'=>'질문제목을 입력해주세요',
			'content'=>'답변내용을 입력해주세요',
		);
		foreach($validationArr as $k=>$v){
			if(!$params[$k]){
				$return=array('code'=>'0001','msg'=>$v);
				echo RetJson($return);
				return;
			}
		}
		$data=array(
			'idx'=>$params['idx'],
			'category'=>$params['category'],
			'question'=>$params['question'],
			'content'=>$params['content'],
		);
		$ret=$this->faq_model->UpdateData($data);
		if($ret){
			$return=array('code'=>'0000','msg'=>'수정성공','data'=>$ret);
		}else{
			$return=array('code'=>'0001','msg'=>'수정실패','data'=>$ret);
		}
		echo RetJson($return);

	}

}
