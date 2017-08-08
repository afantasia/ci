<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

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

		$this->load->model('member_model');
		$this->load->library('encryption');
		$this->load->helper('url');
		//debug용 함수입니다 해당 컨트롤러 클래스내에서 debug=inno로 잡게되면나올수있게 처리해두었습니다.
		if($this->input->get('debug')=='inno'){
			$this->output->enable_profiler();
		}
		$this->load->library('session');
	}
	public function index(){

	}

	/**
	 * @return bool|void
	 * 회원가입 url 호출시 /members/join/
	 * 메소드호출부분과 url호출 부분에 대해서는 정리할예정입니다.
	 */
	public function Join(){
		$params=$this->input->post();
		if(!count($params) ){
			$return=array('code'=>'0001','msg'=>'잘못된 접근입니다.');
			echo RetJson($return);
			return;
		}
		$validationArr=array(
			'email'=>'이메일주소를 입력하셔야합니다.',
			'name'=>'이름을 입력해주세요',
			'password'=>'패스워드를 입력해주세요',
			'id'=>'아이디를 입력해주세요',
		);
		foreach($validationArr as $k=>$v){
			if(!$params[$k]){
				$return=array('code'=>'0001','msg'=>$v);
				echo RetJson($return);
				return;
			}
		}
		if(!function_exists('password_hash')){
			$this->load->helper('password');
		}

		if(isset($params['idx'])){
			//있으면 수정
		}else{
			//없으면 추가
			$hash=password_hash($params['password'],PASSWORD_BCRYPT);
			//아이디 증복체크
			$res=$this->checkid($params['email']);
			$res2=$this->checkEmail($params['id']);
			if($res['code']=='0000' && $res2['code']=='0000'){
				$data=array(
					'email'=>$params['email'],
					'name'=>$params['name'],
					'password'=>$hash,
					'id'=>$params['id'],
				);
				$ret=$this->member_model->RegistMember($data);
			}else{
				return false;
			}
		}
		if($ret){
			$return=array('code'=>'0000','msg'=>'가입성공','data'=>$ret);
		}else{
			$return=array('code'=>'0001','msg'=>'가입실패','data'=>$ret);
		}
		echo RetJson($return);
	}

	/**
	 * @param null $id
	 * @return array|void
	 * 회원아이디 증복체크하는 함수입니다. url 호출시 /member/checkid/이메일주소
	 * 메소드호출부분과 url호출 부분에 대해서는 정리할예정입니다.
	 */
	public function checkid($id=null){
		$this->pdo=$this->load->database('pdo',true);
		$sql = "SELECT * FROM users WHERE email = ? ";
		$query=$this->pdo->query($sql, array($id));
		$data=$query->result();
		if(count($data)>0){
			$return=array('code'=>'0001','msg'=>'증복된 아이디가 있습니다.','data'=>$data);
			echo RetJson($return);
			return;
		}else{
			$return=array('code'=>'0000','msg'=>'가입가능','data'=>$data);
		}
		return $return;
	}

	public function checkEmail($email=null){
		$this->pdo=$this->load->database('pdo',true);
		$sql = "SELECT * FROM users WHERE email = ? ";
		$query=$this->pdo->query($sql, array($email));
		$data=$query->result();
		if(count($data)>0){
			$return=array('code'=>'0001','msg'=>'증복된 이메일주소가 있습니다.','data'=>$data);
			echo RetJson($return);
			return;
		}else{
			$return=array('code'=>'0000','msg'=>'등록가능','data'=>$data);
		}
		return $return;
	}

	/**
	 * URL : /members/login
	 * 로그인 이후 세션까지 만들어줍니다
	 * 패스워드같은경우 암호화되어있긴 하지만 세션저장용량(4KB)이 적어질수있기때문에
	 * 불필요하다고 판단되는 컬럼을 빼놓습니다.
	 */
	public function Login(){
		$params=$this->input->post();
		if(isset($params['email']) && isset($params['password'])){
			if(!function_exists('password_verify')){
				$this->load->helper('password');
			}
			$return=$this->member_model->getDataUserID($params['email']);
			if($return['data']){
				$info=$return['data'][0];
				$checkSum=password_verify($params['password'], $info['password']);
				if($checkSum){
					unset($info['password']);
					$this->session->set_userdata($info);

					$return=array('code'=>'0000','msg'=>'로그인성공','data'=>$checkSum);
				}else{
					$return=array('code'=>'0000','msg'=>'패스워드가 일치하지 않습니다.','data'=>$checkSum);
				}
			}else{
				$return=array('code'=>'0001','msg'=>'회원정보가 없습니다.');
			}
		}else{
			$return=array('code'=>'0001','msg'=>'패스워드 혹은 아이디가  비었습니다.','params'=>$_POST);
		}
		echo RetJson($return);
	}

	/**
	 * URL : /members/login
	 * 현재세션에 로그인이 되어있는지 체크합니다 로그인이 되어있지 않는다면 코드가 0001로 떨어집니다.
	 */
	public function logincheck(){
		$data=$this->session->get_userdata();
		if(isset($data['email'])){
			$return=array('code'=>'0000','msg'=>'로그인중','data'=>$data);
		}else{
			$return=array('code'=>'0001','msg'=>'로그인되어있지않음','data'=>$data);
		}

		echo RetJson($return);
	}

	/**
	 * URL : /members/logout
	 * 로그아웃 처리페이지
	 */
	public  function logout(){
		//로그아웃 기능입니다 따로 체크하지 않고 처리해버려도 되지만 강제로그아웃기능이 필요할수 있습니다
		$this->session->sess_destroy();
		$return=array('code'=>'0000','msg'=>'로그아웃완료');
		echo RetJson($return);

	}

	/**
	 * URL : /members/findid
	 * 아이디 찾기기능입니다.
	 */
	public function findid(){
		$params=$this->input->post();
		$validationArr=array(
			'email'=>'이메일주소를 입력하셔야합니다.',
			'name'=>'이름을 입력해주세요',
		);
		foreach($validationArr as $k=>$v){
			if(!$params[$k]){
				$return=array('code'=>'0001','msg'=>$v);
				echo RetJson($return);
				return;
			}
		}
		$r=$this->member_model->findId($params);
		if($r){
			$return=array('code'=>'0000','msg'=>'조회성공','id'=>$r);
		}else{
			$return=array('code'=>'0001','msg'=>'일치하는 정보가 없습니다.');
		}
		echo RetJson($return);
	}
	public function findpw(){
		$params=$this->input->post();
		$validationArr=array(
			'name'=>'이름을 입력해주세요',
			'id'=>'아이디를 입력해주세요',
			'email'=>'이메일주소를 입력하셔야합니다.',
		);
		foreach($validationArr as $k=>$v){
			if(!$params[$k]){
				$return=array('code'=>'0001','msg'=>$v);
				echo RetJson($return);
				return;
			}
		}
		$r=$this->member_model->findPw($params);
		if($r){

			#$this->load->library('email');
			#$this->email->from('vgbgbg@naver.com', 'Your Name');
			#$this->email->to('vgbgbg@naver.com');
			#$this->email->subject('이메일 테스트입니다.');
			#$this->email->message('변경된 패스워드는 '.$r['str']."입니다.");
			#$rx=$this->email->send();
			#$this->email->print_debugger(['headers', 'subject', 'body']);

			$return=array('code'=>'0000','msg'=>'변경된 임시 패스워드가 '.$params['email'].'로 발송됩니다.','id'=>$r);
		}else{
			$return=array('code'=>'0001','msg'=>'일치하는 정보가 없습니다.');
		}
		echo RetJson($return);

	}
}